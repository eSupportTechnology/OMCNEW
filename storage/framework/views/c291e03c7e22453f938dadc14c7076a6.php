<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <tr style="background-color: #2c3e50;">
                        <td align="center" style="padding: 20px;">
                            <!-- 👇 Replace this with your actual logo image -->
                            <img src="<?php echo e(url('storage/logo_images/' . $siteLogo->image_path)); ?>" alt="Your Logo" width="150" style="display: block;">

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="margin-top: 0; color: #2c3e50;">Hello!</h2>
                            <p style="font-size: 16px; color: #333;">
                                Your verification code is:
                            </p>
                            <h1 style="color: #2c3e50; font-size: 36px; letter-spacing: 4px; margin: 20px 0;"><?php echo e($code); ?></h1>
                            <p style="font-size: 16px; color: #555;">
                                Please enter this code to verify your email. If you didn't request this, you can ignore this email.
                            </p>
                            <p style="font-size: 14px; color: #999; margin-top: 30px;">— Your Website Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f1f1f1; text-align: center; padding: 15px; font-size: 12px; color: #999;">
                            &copy; <?php echo e(date('Y')); ?>  All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
<?php /**PATH C:\Users\ASUS\Desktop\OMC2\OMCNEW\resources\views/emails/verification-code.blade.php ENDPATH**/ ?>