<div class="colorlib-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-4 animate-box">
                    <article>
                        <h2>To do</h2>
                        <ul id="detail-task">
                            <li class="has-dropdown">
                                <p><a style="color: black;" href="#">Task 1</a>
                                    <span onclick="return confirm('Do you really want to delete?');" ><i class="icon-delete" style="color: green"></i></span></p>   `
                            </li>
                            <li class="has-dropdown">
                                <p><a style="color: black;" href="#">Task 1</a>
                                    <span onclick="return confirm('Do you really want to delete?');" ><i class="icon-delete" style="color: green"></i></span></p>   `
                            </li>
                        </ul>
                        <button type="submit" class="btn btn-primary">Add task</button>
                    </article>
            </div>
            <div class="col-md-4 animate-box">
                <article>
                    <h2>In process</h2>
                </article>
            </div>
            <div class="col-md-4 animate-box">
                <article>
                    <h2>Done</h2>
                </article>
            </div>
        </div>
    </div>
</div>

<!--Detail task-->
<div class="detail-modal">
    <div class="detail-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-push-8 animate-box">
                        <h2>Task's Information</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-info-wrap-flex">
                                    <div class="con-info">
                                        <p><span><i class="icon-location-2"></i></span> Name's list <br> ABC </p>
                                    </div>
                                    <div class="con-info">
                                        <p><span><i class="icon-paperplane"></i></span> Status <br> To do </p>
                                    </div>
                                    <div class="con-info">
                                        <p><span><i class="icon-globe"></i></span>Prioty level <br> Medium </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-pull-4 animate-box">
                        <form action="#">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <p>Title</p>
                                    <textarea name="message" id="message" cols="30" rows="1" class="form-control" placeholder="ABC"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <p>Content</p>
                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Detail"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="save" type="submit" value="Save" class="btn btn-primary">
                                <input id="cancel" type="submit" value="Cancel" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    document.getElementById('detail-task').addEventListener('click',
        function(){
            document.querySelector('.detail-modal').style.display = 'flex';
        })
    document.getElementById('cancel').addEventListener('click',
        function () {
            document.querySelector('.detail-modal').style.display = 'none';
        })
</script><?php /**PATH /home/truongphi/internPHP/bigproject/todolistapp/resources/views/user/todo_list/layouts/content.blade.php ENDPATH**/ ?>