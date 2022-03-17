<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            padding: 0px;
            margin: 0px;
            text-align: right;
            direction: rtl;
        }
        #header{
            background: #3498db;
            padding: 10px 15px;
            color: #fff;
        }
    </style>
</head>
<body>
<div id="header">
    <h1>{{ Auth::user()->name }} عزیز خرید شما موفق بود</h1><br>
    <h3>جهت دانلود فایل های خریداری شده به پنل کاربری خود مراجعه کنید.</h3>
</div>
<p class="footer">با تشکر از خرید شما، تیم Kerman-ai</p>
</body>
</html>
