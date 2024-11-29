<div class="container">
    <h1 class="touch_text">Get In Touch</h1>
    <div class="email_box">
        <div class="input_main">
            <form action="/contact" method="POST">
                <div class="form-group">
                    <input type="text" class="email-bt" placeholder="Name" name="Name">
                </div>
                <div class="form-group">
                    <input type="text" class="email-bt" placeholder="Phone" name="Phone">
                </div>
                <div class="form-group">
                    <input type="text" class="email-bt" placeholder="Email" name="Email">
                </div>
                <div class="form-group">
                    <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Message"></textarea>
                </div>
                <div class="send_bt"><input type="submit" value="SEND" /></div>
            </form>
            <?php 
                include __DIR__ . '/show-error.part.view.php';

        ?>
        </div>
    </div>
</div>
