<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3c6a36;
        }

        .comment-container {
            margin-top: 20px;
        }

        .comment {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fff;
        }

        .comment-author {
            font-weight: bold;
            color: #3c6a36;
        }

        .comment-text {
            margin-top: 5px;
        }

        .comment-reply {
            margin-left: 20px;
            border-left: 1px solid #ddd;
            padding-left: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        textarea {
            resize: vertical;
        }

        button, .btn {
            background-color: #ccc;
            color: #000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover, .btn:hover {
            background-color: #3c6a36;
            color: #fff;
        }

        .button-link{
            text-decoration: none;
            color: #fff;
        }
    </style>
    <title>Đánh Giá</title>
</head>

<body>

    <div class="container">
        <h2>Đánh Giá</h2>

        <!-- Comment container -->
        <div class="comment-container">
            <!-- Comment 1 -->
            <div class="comment">
                <p class="comment-author">John Doe</p>
                <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec purus eu elit tincidunt hendrerit.</p>
            </div>

            <!-- Comment 2 -->
            <div class="comment">
                <p class="comment-author">Jane Smith</p>
                <p class="comment-text">Vivamus sagittis mauris id hendrerit finibus. Nunc non fringilla metus. Sed vel elit vel ligula eleifend hendrerit.</p>
            </div>

            <!-- Add more comments and replies as needed -->
        </div>

        <!-- Form comment -->
        <form action="#" method="post">
            <div class="form-group">
                <label for="comment">Bình luận:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn">Gửi Bình luận</button>
        </form>
    </div>

    <div class="back-home" style="display: flex;justify-content: center; margin-top: 20px;">
    <a class="btn" href="index.php">Trở về trang chủ</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
