<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Design Area</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
     <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'powerpaste casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export print autosave',
            toolbar: 'undo redo | styleselect | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | link image | table | pagebreak | insertdatetime | wordcount | print | help',
            height: 600,
            autosave_interval: '30s',
            content_style: `
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                }
            `
        });
    </script>
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

        #editor {
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav>
        <label class="logo">designX</label>
        <ul>
            <li><a class="active" href="#">create</a></li>
            <li><a href="#">template</a></li>
            <li><a href="upload.php">upload</a></li>
            <li><a href="#">publish</a></li>
            <li><a href="#">log out</a></li>
        </ul>
    </nav>
    <h1>Online Book Editor</h1>
    <form method="post">
        <textarea id="editor"></textarea>
    </form>
</body>

</html>