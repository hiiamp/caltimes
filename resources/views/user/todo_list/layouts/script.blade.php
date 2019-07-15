<script>
    try {
        $('#spinner-li').hide();
    } catch (e) {

    }
</script>
@if(\Illuminate\Support\Facades\Auth::check())
    <script type="text/javascript">
        $( function function1() {
            function temp(){
                $( "#sortable1, #sortable2, #sortable3" ).sortable({
                    scroll: true,
                    axis: "x,y",
                    zIndex: 999999,
                    containment: "body",
                    revert: true,
                    helper: "clone",
                    disable: false,
                    connectWith: ".connectedSortable",
                    update: function(event,ui){
                        var status_task = $(this).attr('id')
                        $(this).children().each(function (index) {
                            if ($(this).attr('data-position') != (index+1)) {
                                $(this).attr('data-position',(index+1)).addClass('updated')
                            }
                            $(this).addClass('updated');
                        })
                        saveNewPositions(status_task)
                    }
                }).disableSelection();
                function saveNewPositions(status_task)
                {
                    var positions = [];
                    var status_id;
                    $('.updated').each(function () {
                        if (status_task == 'sortable1') {
                            status_id=1;
                        }
                        else if (status_task == 'sortable2') {
                            status_id=2;
                        }
                        else if (status_task == 'sortable3') {
                            status_id=3;
                        }
                        positions.push([$(this).attr('data-index'), $(this).attr('data-position'), status_id]);
                        console.log(positions);
                        $(this).removeClass('updated');
                    });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('content_swapPosition') }}',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            update: 1,
                            positions: positions,
                            status_id: status_id
                        }, success: function (response) {

                        }
                    });
                }
                $('.ats').hide();
                $(function(){
                    $('#sortable1 li, #sortable2 li, #sortable3 li').mousedown(function(event){
                        $(this).bind("contextmenu",function(e){
                            e.preventDefault();
                        });
                        switch (event.which) {
                            case 1:
                                $('#sortable1 li, #sortable2 li, #sortable3 li').parent().parent().parent().css('z-index','2');
                                $(this).parent().parent().parent().css('z-index','50');
                                $(this).css({'transform':' rotate(5deg)','z-index':'100'});
                                break;
                            case 3:
                                $(this).children('span').toggle();
                                break;
                            default:
                                break;
                        }
                    });
                    $('#sortable1 li, #sortable2 li, #sortable3 li').mouseleave(function(event){
                        $(this).css({'transform':' rotate(0deg)'});
                    });
                    $(document).click(function (e)
                    {
                        // Đối tượng container chứa popup
                        var container = $("#sortable1 li, #sortable2 li, #sortable3 li").children('span');

                        // Nếu click bên ngoài đối tượng container thì ẩn nó đi
                        if (!container.is(e.target) && container.has(e.target).length === 0)
                        {
                            container.hide();
                        }
                    });
                });
                var dialog_share = document.querySelector('#sharewithdialog');
                document.querySelector('.sharewith').onclick = function() {
                    dialog_share.showModal();
                };
                document.querySelector('#share').onclick = function() {
                    dialog_share.close();
                };
                document.querySelector('#cancelshare').onclick = function() {
                    dialog_share.close();
                };
                var dialog_favourite = document.querySelector('#myfavourite_dialog');
                document.querySelector('#myfavourite').onclick = function() {
                    dialog_share.close();
                    dialog_favourite.showModal();
                };
                $('.sharefv').each(function () {
                    $(this).click(function () {
                        var user_id = $(this).attr('data-id');
                        var todo_list_id = $(this).attr('list-id');
                        var check = true;
                        if($(this).attr('data-fv') === 'no') check = false;
                        if(check){
                            $(this).attr('data-fv', 'no');
                            $(this).attr('value', 'Share this list');
                        } else {
                            $(this).attr('data-fv', 'yes');
                            $(this).attr('value', 'UnShare');
                        }
                        $.ajax({
                            url : '{{ route('toggleShareList') }}',
                            dataType: 'json',
                            data:{'user_id': user_id,
                                'todo_list_id': todo_list_id
                            },
                            success:function(data){

                            }
                        });
                    });
                });
                document.querySelector('#fvdialogcancel').onclick = function() {
                    dialog_favourite.close();
                };
                //===============
                var dialog_delete = document.querySelector('#deletelistdialog');
                document.querySelector('#delete_list').onclick = function () {
                    dialog_delete.showModal();
                };
                document.querySelector('#delete_submit').onclick = function () {
                    dialog_delete.close();
                };
                document.querySelector('#delete_cancel').onclick = function () {
                    dialog_delete.close();
                };
                var dialog_delete_task = document.querySelector('#deletetaskdialog');
                $('.delete_task').each(function (index) {
                    $(this).click(function () {
                        document.querySelector('#detail-dialog').close();
                        dialog_delete_task.showModal();
                        var task_id = $(this).attr('data-index');
                        $('#delete_task_id').attr('value',task_id);
                    });
                });
                document.querySelector('#delete_task_submit').onclick = function () {
                    dialog_delete_task.close();
                };
                document.querySelector('#delete_task_cancel').onclick = function () {
                    dialog_delete_task.close();
                };

                var dialog_edit = document.querySelector('#detail-dialog');
                $( "#sortable1, #sortable2, #sortable3" ).children().each(function(index) {
                    $(this).click(function(){
                        dialog_edit.showModal();
                        //console.log($(this).attr('data-index'));
                        var task_id = $(this).attr('data-index');
                        $('#task_edit_id').attr('value',task_id);
                        $('.delete_task').hide().attr('disabled', '');
                        $('.prioty').hide().attr('disabled','');
                        $('#priority'+task_id).show();
                        var t_id = task_id;
                        $('#deletetask'+task_id).show();
                        $('#deletetask'+task_id).removeAttr('disabled');
                        var name_id = 'name' + task_id;
                        var content_id = 'content' + task_id;
                        task_id = 'assign' + task_id;
                        $('.hiddenn').attr('hidden', 'hidden');
                        $('.showw').removeAttr('hidden');
                        document.getElementById(task_id).attributes.removeNamedItem('hidden');
                        document.getElementById('priority' + t_id).attributes.removeNamedItem('disabled');
                        var user_id = document.getElementById(task_id).getAttribute('value');
                        if(user_id !== '1') {
                            user_id = 'choose' + user_id;
                            var hidden = document.createAttribute('hidden');
                            hidden.value = 'hidden';
                            document.getElementById(user_id).attributes.setNamedItem(hidden);
                        }
                        var selected = document.createAttribute("selected");
                        selected.value = 'selected';
                        document.getElementById(task_id).attributes.setNamedItem(selected);
                        //document.getElementById("ownertask").innerHTML = "";

                        var status = $(this).parent().attr('type');
                        document.getElementById(status).attributes.removeNamedItem('hidden');

                        $(".hidden_dis").attr('hidden', 'hidden').attr('disabled', '').parent().hide();
                        document.getElementById(name_id).attributes.removeNamedItem('disabled');
                        document.getElementById(name_id).attributes.removeNamedItem('hidden');
                        $('#'+name_id).parent().show();
                        document.getElementById(content_id).attributes.removeNamedItem('disabled');
                        document.getElementById(content_id).attributes.removeNamedItem('hidden');
                        $('#'+content_id).parent().show();
                    });
                });
                document.querySelector('#save11').onclick = function() {
                    dialog_edit.close();
                };
                document.querySelector('#out11').onclick = function() {
                    dialog_edit.close();
                };
                //add task dialog
                var dialog1 = document.querySelector('#create-task');
                document.querySelector('#add-task').onclick = function() {
                    dialog1.showModal();
                };
                document.querySelector('#save1').onclick = function() {
                    dialog1.close();
                };
                document.querySelector('#out1').onclick = function() {
                    dialog1.close();
                };

                //header, xu ly coworker
                var dialog_out = document.querySelector('#out_list_dialog');
                document.querySelector('#outlist').onclick = function () {
                    dialog_out.showModal();
                };
                document.querySelector('#delete_access_cancel').onclick = function () {
                    dialog_out.close();
                };
                var dialog4 = document.querySelector('#dialogjoined');
                document.querySelector('.worker_joined').onclick = function() {
                    dialog4.showModal();
                };
                document.querySelector('#joinedcancel').onclick = function () {
                    dialog4.close();
                };
                $('.listwk').each(function () {
                    $(this).click(function () {
                        var user_co_id = $(this).attr('data-id');
                        var check = true;
                        if($(this).attr('data-wk') === 'no') check = false;
                        if(check){
                            $(this).attr('data-wk', 'no');
                            $(this).attr('value', 'Add favorite');
                        } else {
                            $(this).attr('data-wk', 'yes');
                            $(this).attr('value', 'Remove favorite');
                        }
                        $.ajax({
                            url : '{{ route('toggleCoWorker') }}',
                            dataType: 'json',
                            data:{'user_co_id': user_co_id},
                            success:function(data){

                            }
                        });
                    });
                });
                $('.sharewk').each(function () {
                    $(this).click(function () {
                        var user_id = $(this).attr('data-id');
                        var todo_list_id = $(this).attr('list-id');
                        var check = true;
                        if($(this).attr('data-wk') === 'no') check = false;
                        if(check){
                            $(this).attr('data-wk', 'no');
                            $(this).attr('value', 'Approve join');
                        } else {
                            $(this).attr('data-wk', 'yes');
                            $(this).attr('value', 'Kick out?');
                        }
                        $.ajax({
                            url : '{{ route('toggleShareList') }}',
                            dataType: 'json',
                            data:{'user_id': user_id,
                                'todo_list_id': todo_list_id
                            },
                            success:function(data){

                            }
                        });
                    });
                });
            }
            temp();
            $('#search').on('keyup',function(){
                var search = $('#search').val();
                var todo_list_id = $('#list_id1').attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{ route('searchTask') }}',
                    dataType: 'json',
                    data:{'todo_list_id': todo_list_id,
                        'search':search},
                    success:function(data){
                        //console.log(temp.outerHTML);
                        $('.displayTask').html(data.table_data);
                        temp();
                    }
                });
            });
            //dialog share

            //==================
            $('#add-task').click(function(){
                var max = 0;
                $('#sortable1').children().each(function () {
                    if($(this).attr('data-position')>max){
                        max = $(this).attr('data-position');
                    }
                });
                max = Number(max);
                $('#position_create').attr('value', max+1);
                $('#add-task-form')[0].reset();
                $('#button_action').val('insert');
                $('#save1').val('Create');
            });

            $('#add-task-form').on('submit',function (event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url : '{{ route('create_task') }}',
                    method: "get",
                    data:form_data,
                    dataType: 'json',
                    success:function(data){
                        $('#sortable1').html($('#sortable1').html() + data.out);
                        $('#detail-dialog').html(data.detail);
                        $('#add-task-form')[0].reset();
                        $('#save1').val('Create');
                        $('#button_action').val('insert');
                        console.log(data.out);

                        temp();
                    }
                });
            })
        } );
    </script>
@else
    <script type="text/javascript">
        $( function function1() {
            function temp(){
                $( "#sortable1, #sortable2, #sortable3" ).sortable({
                    scroll: true,
                    axis: "x,y",
                    zIndex: 999999,
                    containment: "body",
                    revert: true,
                    helper: "clone",
                    disable: false,
                    connectWith: ".connectedSortable",
                    update: function(event,ui){
                        var status_task = $(this).attr('id')
                        $(this).children().each(function (index) {
                            if ($(this).attr('data-position') != (index+1)) {
                                $(this).attr('data-position',(index+1)).addClass('updated')
                            }
                            $(this).addClass('updated');
                        })
                        saveNewPositions(status_task)
                    }
                }).disableSelection();
                function saveNewPositions(status_task)
                {
                    var positions = [];
                    var status_id;
                    $('.updated').each(function () {
                        if (status_task == 'sortable1') {
                            status_id=1;
                        }
                        else if (status_task == 'sortable2') {
                            status_id=2;
                        }
                        else if (status_task == 'sortable3') {
                            status_id=3;
                        }
                        positions.push([$(this).attr('data-index'), $(this).attr('data-position'), status_id]);
                        console.log(positions);
                        $(this).removeClass('updated');
                    });

                }
                $('.ats').hide();
                $(function(){
                    $('#sortable1 li, #sortable2 li, #sortable3 li').mousedown(function(event){
                        $(this).bind("contextmenu",function(e){
                            e.preventDefault();
                        });
                        switch (event.which) {
                            case 1:
                                $('#sortable1 li, #sortable2 li, #sortable3 li').parent().parent().parent().css('z-index','2');
                                $(this).parent().parent().parent().css('z-index','50');
                                $(this).css({'transform':' rotate(5deg)','z-index':'100'});
                                break;
                            case 3:
                                $(this).children('span').toggle();
                                break;
                            default:
                                break;
                        }
                    });
                    $('#sortable1 li, #sortable2 li, #sortable3 li').mouseleave(function(event){
                        $(this).css({'transform':' rotate(0deg)'});
                    });
                    $(document).click(function (e)
                    {
                        // Đối tượng container chứa popup
                        var container = $("#sortable1 li, #sortable2 li, #sortable3 li").children('span');

                        // Nếu click bên ngoài đối tượng container thì ẩn nó đi
                        if (!container.is(e.target) && container.has(e.target).length === 0)
                        {
                            container.hide();
                        }
                    });
                });
                var dialog_edit = document.querySelector('#detail-dialog');
                $( "#sortable1, #sortable2, #sortable3" ).children().each(function(index) {
                    $(this).click(function(){
                        dialog_edit.showModal();
                        //console.log($(this).attr('data-index'));
                        var task_id = $(this).attr('data-index');
                        $('#task_edit_id').attr('value',task_id);
                        $('.delete_task').hide().attr('disabled', '');
                        $('.prioty').hide().attr('disabled','');
                        $('#priority'+task_id).show();
                        var t_id = task_id;
                        $('#deletetask'+task_id).show();
                        var name_id = 'name' + task_id;
                        var content_id = 'content' + task_id;
                        task_id = 'assign' + task_id;
                        $('.hiddenn').attr('hidden', 'hidden');
                        $('.showw').removeAttr('hidden');
                        document.getElementById(task_id).attributes.removeNamedItem('hidden');
                        document.getElementById('priority' + t_id).attributes.removeNamedItem('disabled');
                        var user_id = document.getElementById(task_id).getAttribute('value');
                        if(user_id !== '1') {
                            user_id = 'choose' + user_id;
                            var hidden = document.createAttribute('hidden');
                            hidden.value = 'hidden';
                            document.getElementById(user_id).attributes.setNamedItem(hidden);
                        }
                        var selected = document.createAttribute("selected");
                        selected.value = 'selected';
                        document.getElementById(task_id).attributes.setNamedItem(selected);
                        //document.getElementById("ownertask").innerHTML = "";

                        var status = $(this).parent().attr('type');
                        document.getElementById(status).attributes.removeNamedItem('hidden');

                        $(".hidden_dis").attr('hidden', 'hidden').attr('disabled', '').parent().hide();
                        document.getElementById(name_id).attributes.removeNamedItem('disabled');
                        document.getElementById(name_id).attributes.removeNamedItem('hidden');
                        $('#'+name_id).parent().show();
                        document.getElementById(content_id).attributes.removeNamedItem('disabled');
                        document.getElementById(content_id).attributes.removeNamedItem('hidden');
                        $('#'+content_id).parent().show();
                    });
                });
                document.querySelector('#out11').onclick = function() {
                    dialog_edit.close();
                };

                //header, xu ly coworker
                var dialog4 = document.querySelector('#dialogjoined');
                document.querySelector('.worker_joined').onclick = function() {
                    dialog4.showModal();
                };
                document.querySelector('#joinedcancel').onclick = function () {
                    dialog4.close();
                };
                $('.listwk').each(function () {
                    $(this).click(function () {
                        var user_co_id = $(this).attr('data-id');
                        var check = true;
                        if($(this).attr('data-wk') === 'no') check = false;
                        if(check){
                            $(this).attr('data-wk', 'no');
                            $(this).attr('value', 'Add favorite');
                        } else {
                            $(this).attr('data-wk', 'yes');
                            $(this).attr('value', 'Remove favorite');
                        }
                        $.ajax({
                            url : '{{ route('toggleCoWorker') }}',
                            dataType: 'json',
                            data:{'user_co_id': user_co_id},
                            success:function(data){

                            }
                        });
                    });
                });
            }
            temp();
            $('#search').on('keyup',function(){
                var search = $('#search').val();
                var todo_list_id = $('#list_id1').attr('value');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : '{{ route('searchTask') }}',
                    dataType: 'json',
                    data:{'todo_list_id': todo_list_id,
                        'search':search},
                    success:function(data){
                        //console.log(temp.outerHTML);
                        $('.displayTask').html(data.table_data);
                        temp();
                    }
                });
            });

            //===============

            //==================
        } );
    </script>
@endif
