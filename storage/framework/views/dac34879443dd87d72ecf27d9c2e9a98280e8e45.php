<section id="home" class="video-hero" style="height: 500px; background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
    <div class="overlay"></div>
    <a class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=vqqt5p0q-eU',containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'default'}"></a>
    <div class="display-t text-center">
        <div class="display-tc">
            <div class="container">
                <div class="col-md-12 col-md-offset-0">
                    <div class="animate-box">
                        <h2>Take on your biggest projects and goals</h2>
                        <p id="create-board"><a href="#" class="btn btn-primary btn-lg btn-custom">Create new board</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<dialog>
    <form method="post" action="<?php echo e('create_list'); ?>">
        <?php echo csrf_field(); ?>
        <div class="row form-group">
            <div class="col-md-12">
                <p>Setup your board</p>
                <input id="name" type="name" class="form-control" name="name" required autofocus placeholder="Your board title">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <select name="is_public" class="custom-select" id="is_public">
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input id="save" type="submit" value="Create" class="btn btn-primary">
            <input id="cancel" type="reset" value="Cancel" class="btn btn-primary">
        </div>
    </form>
</dialog>

<script>
    var dialog = document.querySelector('dialog');
    document.querySelector('#create-board').onclick = function() {
        dialog.showModal();
    };
    document.querySelector('#save').onclick = function() {
        dialog.close();
    };
    document.querySelector('#cancel').onclick = function() {
        dialog.close();
    };
</script>

<?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/user/home/layouts/header.blade.php ENDPATH**/ ?>