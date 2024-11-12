<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online eBook Platform - Upload</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        nav {
            background: #0d0d0e;
            height: 80px;
            width: 100%;
        }

        label.logo {
            color: white;
            font-size: 35px;
            line-height: 80px;
            padding: 0 100px;
            font-weight: bold;
        }

        nav ul {
            float: right;
            margin-right: 20px;
        }

        nav ul li {
            display: inline-block;
            line-height: 80px;
            margin: 0 5px;
        }

        nav ul li a {
            color: white;
            font-size: 17px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
        }
        
        a.active,
        a:hover {
            background: #1b9bff;
            transition: 5s;
        }
        h1 {
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="file"] {
            display: block;
            margin: 10px 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Upload Your Book or Image</h1>
    <nav>
        <label class="logo">designX</label>
        <ul>
            <li><a  href="edit.php">create</a></li>
            <li><a href="#">template</a></li>
            <li><a class="active" href="upload.php">upload</a></li>
            <li><a href="#">publish</a></li>
            <li><a href="#">log out</a></li>
        </ul>
    </nav>
    <br><br><br>
    <h1>Online Book Editor</h1>
    <?php
    // CSRF Token
    session_start();
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    // Input Sanitization Function
    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    // File Type Validation Function
    function validateFileType($file, $allowedTypes) {
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($fileExtension, $allowedTypes);
    }

    // Form Submission Handler
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bookFile = $_FILES['book'];
        $imageFile = $_FILES['image'];

        // Validate file types
        $allowedTypes = ['pdf', 'txt', 'jpg', 'jpeg', 'png'];
        
        if (!validateFileType($bookFile, $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid book file. Please upload a PDF or TXT file.</div>";
        } elseif (!validateFileType($imageFile, $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid image file. Please upload a JPG or PNG file.</div>";
        } elseif ($bookFile['size'] > 5 * 1024 * 1024) { // 5MB limit
            echo "<div class='alert alert-danger'>Book file size exceeds 5MB limit.</div>";
        } elseif ($imageFile['size'] > 2 * 1024 * 1024) { // 2MB limit
            echo "<div class='alert alert-danger'>Image file size exceeds 2MB limit.</div>";
        } else {
            // CSRF protection
            if (!hash_equals($_SESSION['token'], $_POST['_csrf_token'])) {
                echo "<div class='alert alert-danger'>CSRF token mismatch.</div>";
            } else {
                // Here you would typically save the files to a server directory
                // For this example, we'll just display success message
                echo "<div class='alert alert-success'>Upload successful!</div>";
                
                // Display file information (for demonstration purposes only)
                echo "<pre>Book File: ";
                print_r($bookFile);
                echo "</pre>";
                
                echo "<pre>Image File: ";
                print_r($imageFile);
                echo "</pre>";
            }
        }
    }
    ?>
    <div class="container">
        <form id="uploadForm" enctype="multipart/form-data">
            <label for="bookUpload">Upload a Book (PDF or TXT):</label>
            <input type="file" id="bookUpload" name="book" accept=".pdf, .txt" required>

            <label for="imageUpload">Upload an Image (JPG or PNG):</label>
            <input type="file" id="imageUpload" name="image" accept=".jpg, .jpeg, .png" required>

            <button type="submit">Upload</button>
        </form>
        <div class="message" id="message"></div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting the default way

            const bookFile = document.getElementById('bookUpload').files[0];
            const imageFile = document.getElementById('imageUpload').files[0];

            if (bookFile && imageFile) {
                const formData = new FormData();
                formData.append('book', bookFile);
                formData.append('image', imageFile);

                // Simulate an upload process (replace with actual upload logic)
                fetch('YOUR_UPLOAD_URL_HERE', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('message').innerText = 'Upload successful!';
                })
                .catch(error => {
                    document.getElementById('message').innerText = 'Upload failed. Please try again.';
                });
            } else {
                document.getElementById('message').innerText = 'Please select both a book and an image.';
            }
        });
    </script>

</body>

</html