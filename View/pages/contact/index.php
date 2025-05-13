<?php
// app/Views/contact/index.php

// Include the default layout (header, footer, navigation)
// The $data variable is passed from the ContactController
// $data["title"], $data["description"], $data["categories"] (for nav)
// $data["name"], $data["email"], $data["subject"], $data["message"]
// $data["name_err"], $data["email_err"], $data["subject_err"], $data["message_err"], $data["success_message"]

require APPROOT . 
'/Views/layouts/default.php


?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2><?php echo htmlspecialchars($data["title"]); ?></h2>
            <p><?php echo htmlspecialchars($data["description"]); ?></p>
            <hr>

            <?php if (!empty($data["success_message"])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlspecialchars($data["success_message"]); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/contact/submit" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control <?php echo (!empty($data["name_err"])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data["name"]); ?>">
                    <div class="invalid-feedback"><?php echo $data["name_err"]; ?></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data["email_err"])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data["email"]); ?>">
                    <div class="invalid-feedback"><?php echo $data["email_err"]; ?></div>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">الموضوع <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control <?php echo (!empty($data["subject_err"])) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($data["subject"]); ?>">
                    <div class="invalid-feedback"><?php echo $data["subject_err"]; ?></div>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">الرسالة <span class="text-danger">*</span></label>
                    <textarea name="message" id="message" class="form-control <?php echo (!empty($data["message_err"])) ? 'is-invalid' : ''; ?>" rows="5"><?php echo htmlspecialchars($data["message"]); ?></textarea>
                    <div class="invalid-feedback"><?php echo $data["message_err"]; ?></div>
                </div>

                <button type="submit" class="btn btn-primary">إرسال الرسالة</button>
            </form>
        </div>
    </div>
</div>

<?php 
// The default layout includes the footer.
?>

