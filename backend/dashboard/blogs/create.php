<?php
require '../../includes/auth.php';
require '../../includes/db.php';
require '../../includes/discord_webhook.php'; // Voeg de webhook-functionaliteit toe
include '../../templates/header.php';

check_role(['admin', 'author']); // Accessible only for admins and authors

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']); // Content will come from the hidden textarea
    $status = $_POST['status'];
    $author_id = $_SESSION['user_id'];

    if (!empty($title) && !empty($content) && in_array($status, ['draft', 'published', 'archived'])) {
        $stmt = $conn->prepare("INSERT INTO blogs (title, content, status, author_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $content, $status, $author_id);

        if ($stmt->execute()) {
            $success = "Blog post created successfully.";
            
            // Controleer of de blog is gepubliceerd
            if ($status === 'published') {
                $blog_id = $conn->insert_id;
                $blog_url = "https://exorth.net/view.php?id=$blog_id";
                
                // Verstuur bericht naar Discord
                sendToDiscord($title, $blog_url);
            }
        } else {
            $error = "Failed to save the blog post. Please try again.";
        }
    } else {
        $error = "All fields are required, and the status must be valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <title>Create Blog</title>
    <style>
        #editor-container {
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Create Blog Post</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form id="create-form" action="create.php" method="post" class="mt-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the blog title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <div id="editor-container"></div>
                <!-- Hidden textarea to store Quill's HTML output -->
                <textarea id="content" name="content" class="form-control" style="display: none;" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" onclick="saveContent()">Save</button>
        </form>
        <a href="list.php" class="btn btn-secondary mt-3">Back to Blog List</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize Quill editor with custom image handler
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image'], // Add image functionality
                        ['clean']
                    ],
                    handlers: {
                        image: function () {
                            const url = prompt('Enter the image URL:');
                            if (url) {
                                const width = prompt('Enter the image width (e.g., 300px or 50%):', '300px');
                                const alignment = prompt('Enter alignment (left, center, right):', 'center');
                                const range = this.quill.getSelection();

                                // Determine alignment class
                                let alignClass = '';
                                if (alignment === 'left') {
                                    alignClass = 'float-start';
                                } else if (alignment === 'right') {
                                    alignClass = 'float-end';
                                } else if (alignment === 'center') {
                                    alignClass = 'mx-auto d-block';
                                }

                                // Insert image with custom styling
                                this.quill.insertEmbed(range.index, 'image', url);
                                const [img] = this.quill.root.querySelectorAll('img[src="' + url + '"]');
                                img.style.width = width;
                                img.className = alignClass;
                            }
                        }
                    }
                }
            }
        });

        // Save the Quill content to the hidden textarea
        function saveContent() {
            var contentField = document.getElementById('content');
            contentField.value = quill.root.innerHTML;
        }
    </script>
</body>
</html>
