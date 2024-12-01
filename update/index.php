<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://websolutionus.com/uploads/website-images/web-solution-us-favicon.png" type="image/x-icon">
    <title>Software Update Wizard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .wsus__wizard_area {
            width: 100%;
            height: 100%;
            background: #02a9ee17;
            padding: 100px;
        }

        .wsus__wizard_area_logo {
            display: block;
            width: 300px;
            margin: 0 auto;
        }

        .wsus__wizard_header {
            text-align: center;
            margin: 30px 0px 30px 0px;
            background: #02a9ee;
            padding: 24px 0px;
            border-radius: 6px;
        }

        .wsus__wizard_header h5 {
            font-weight: 600;
            font-size: 20px;
            margin-bottom: 14px;
            color: #fff;
        }

        .wsus__wizard_header p {
            text-transform: capitalize;
            font-size: 16px;
            font-weight: 400;
            max-width: 69%;
            margin: 0 auto;
            color: #fff;
        }

        .wsus__wizard_body {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .wsus__wizard_main_content ul {
            display: flex;
            flex-wrap: wrap;
        }

        .wsus__wizard_main_content ul li {
            list-style: none;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            background: #eef8fca8;
            padding: 20px 30px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #02a9ee3d;
        }

        .wsus__wizard_main_content ul li:last-child {
            margin-bottom: 0;
        }

        .wsus__wizard_main_content ul li a {
            background: #02a9ee;
            color: #fff;
            text-decoration: none;
            padding: 10px 30px;
            border-radius: 30px;
            transition: all linear .3s;
            -webkit-transition: all linear .3s;
            -moz-transition: all linear .3s;
            -ms-transition: all linear .3s;
            -o-transition: all linear .3s;
        }

        .wsus__wizard_main_content ul li a:hover {
            background: #0381b8;
        }

        .wsus__wizard_footer .settings {
            margin: 30px 0px;
        }

        .wsus__wizard_footer .settings span {
            font-weight: 600;
            color: #02a9ee;
        }

        .wsus__wizard_footer .copyright {
            background: #02a9ee;
            text-align: center;
            padding: 20px 0px;
            border-radius: 5px;
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="wsus__wizard_area">
        <div class="wsus__wizard_body">
            <a class="wsus__wizard_area_logo" href="https://websolutionus.com">
                <img src="https://websolutionus.com/uploads/website-images/web-solution-us.png" alt="websolutionus">
            </a>
            <div class="wsus__wizard_header">
                <h5>Software Update Wizard</h5>
                <p>if any of those failed, try again, Don't forget to keep a backup your script and database, if
                    possible do
                    update in staging site first</p>
            </div>
            <div class="wsus__wizard_main_content">
                <ul>
                <li><span>Update App File</span><a class="replace_btn" href="javascript:;" data-action_type="replace_app_file">Update</a></li>

                <li><span>Update Modules Files</span><a class="replace_btn" href="javascript:;" data-action_type="replace_module_file">Update</a></li>

                <li><span>Language Generate</span><a class="replace_btn" href="javascript:;" data-action_type="language_generate">Update</a></li>

                </ul>
            </div>
            <div class="wsus__wizard_footer">
                
            <p class="settings">After successfully update all of above files, go to your admin panel, <span>Settings > Database Generate</span> . Generate the database change to work properly with the update.</span>
                </p>
                
                <p class="copyright">© 2023 All Right Reserved By <b>websolutionus</b></p>
            </div>
        </div>
    </div>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    $(".replace_btn").on("click", function(e){
        e.preventDefault();


        let action_type = $(this).data('action_type');

        let click_btn = $(this);
        $(this).html('Updating..');

        let current_url = window.location.href;
        current_url = current_url+"/ajax.php";

        $.ajax({
            type: 'POST',
            url: current_url,
            data:{action_type},
            success: function (data){
                click_btn.html('Updated')
                var jsonData = JSON.parse(data);
                toastr.success(jsonData.msg)
            },
            errors: function (response){
                click_btn.html('Update');
                toastr.error('Something went wrong, please try again')
            },
        });

    })
</script>
</body>

</html>
