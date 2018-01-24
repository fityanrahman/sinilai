<div class="row">
    <div class="col s12">
      <div class="card">
        <!-- <div class="card-content light-blue lighten-1 white-text"> -->
        <div class="card-content">
          <span class="card-title">Saran</span>
          <!-- debug query -->
          <!-- <?php //$query =$this->db->last_query(); ?> -->
          <!-- <?php //print_r($query);?>  -->
          <!-- debug query -->
        </div>
        <div class="card-content">
        <h6>Kirim Saran ke</h6>
          <table class="bordered highlight">
          <?php foreach ($teman->result() as $item) { ?>
            <tr>
                <?php if($this->session->userdata('level') === '2'){ ?>
                <td><a href="javascript:;" data-friend="<?= $item->id ?>"><?= $item->nama_siswa ?></a></td>
                <?php } else if($this->session->userdata('level') === '3'){ ?>
                <td><a href="javascript:;" data-friend="<?= $item->id ?>"><?= $item->nama_guru ?></a></td>
                <?php } else { ?>
                <td><a href="javascript:;" data-friend="<?= $item->id ?>"><?= $item->username ?></a></td>
                <?php } ?>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
</div>

<!-- TEMPLATE -->
<div id="wgt-container-template" style="display: none">
    <div class="msg-wgt-container">
        <div class="msg-wgt-header">
            <!-- <a href="javascript:;" class="online"></a> -->
            <a href="javascript:;" class="name"></a>
            <a href="javascript:;" class="close">x</a>
        </div>
        <div class="msg-wgt-message-container">
            <table width="100%" class="msg-wgt-message-list">
            </table>
        </div>
        <div class="msg-wgt-message-form">
            <textarea name="messagesaran" placeholder="Type your message. Press Shift + Enter for newline"></textarea>
        </div>
    </div>
</div>

<script type="text/x-template" id="msg-template" style="display: none">
    <tbody>
        <tr class="msg-wgt-message-list-header">
            <td rowspan="2"><img src="<?php base_url('assets/images/noavatar.png') ?>"></td>
            <td class="name"></td>
            <td class="time"></td>
        </tr>
        <tr class="msg-wgt-message-list-body">
            <td colspan="2"></td>
        </tr>
        <tr class="msg-wgt-message-list-separator"><td colspan="3"></td></tr>
    </tbody>
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
    var chatPosition = [
        false, // 1
        false, // 2
        false, // 3
    ];

    // New chat
    $(document).on('click', 'a[data-friend]', function(e) {
        var $data = $(this).data();
        if ($data.friend !== undefined && chatPosition.indexOf($data.friend) < 0) {
            var posRight = 0;
            var position;
            for(var i in chatPosition) {
                if (chatPosition[i] == false) {
                    posRight = (i * 270) + 20;
                    chatPosition[i] = $data.friend;
                    position = i;
                    break;
                }
            }
            var tpl = $('#wgt-container-template').html();
            var tplBody = $('<div/>').append(tpl);
            tplBody.find('.msg-wgt-container').addClass('msg-wgt-active');
            tplBody.find('.msg-wgt-container').css('right', posRight + 'px');
            tplBody.find('.msg-wgt-container').attr('data-chat-position', position);
            tplBody.find('.msg-wgt-container').attr('data-chat-with', $data.friend);
            $('body').append(tplBody.html());
            initializeChat();
        }
    });

    // Minimize Maximize
    $(document).on('click', '.msg-wgt-header > a.name', function() {
        var parent = $(this).parent().parent();
        if (parent.hasClass('minimize')) {
            parent.removeClass('minimize')
        } else {
            parent.addClass('minimize');
        }
    });

    // Close
    $(document).on('click', '.msg-wgt-header > a.close', function() {
        var parent = $(this).parent().parent();
        var $data = parent.data();
        parent.remove();
        chatPosition[$data.chatPosition] = false;
        setTimeout(function() {
            initializeChat();
        }, 1000)
    });

    var chatInterval = [];

    var initializeChat = function() {
        $.each(chatInterval, function(index, val) {
            clearInterval(chatInterval[index]);   
        });

        $('.msg-wgt-active').each(function(index, el) {
            var $data = $(this).data();
            var $that = $(this);
            var $container = $that.find('.msg-wgt-message-container');

            chatInterval.push(setInterval(function() {

                var oldscrollHeight = $container[0].scrollHeight;
                var oldLength = 0;
                $.post('<?= site_url('saran/getChats') ?>', {chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                    $that.find('a.name').text(data.username);
                    // from last
                    var chatLength = data.sarans.length;
                    var newIndex = data.sarans.length;
                    $.each(data.sarans, function(index, el) {
                        newIndex--;
                        var val = data.sarans[newIndex];

                        var tpl = $('#msg-template').html();
                        var tplBody = $('<div/>').append(tpl);
                        var id = (val.id +'_'+ val.send_by +'_'+ val.send_to).toString();
                        

                        if ($that.find('#'+ id).length == 0) {
                            tplBody.find('tbody').attr('id',id); // set class
                            tplBody.find('td.name').text(val.username); // set name
                            tplBody.find('td.time').text(val.time); // set time
                            tplBody.find('.msg-wgt-message-list-body > td').html(nl2br(val.messagesaran)); // set message
                            $that.find('.msg-wgt-message-list').append(tplBody.html()); // append message

                            //Auto-scroll
                            var newscrollHeight = $container[0].scrollHeight - 20; //Scroll height after the request
                            if (newIndex === 0) {
                                $container.animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }
                        }
                    });
                });
            }, 1000));

            $that.find('textarea').on('keydown', function(e) {
                var $textArea = $(this);
                if (e.keyCode === 13 && e.shiftKey === false) {
                    $.post('<?= site_url('saran/sendMessage') ?>', {messagesaran: $textArea.val(), chatWith: $data.chatWith}, function(data, textStatus, xhr) {
                    });
                    $textArea.val(''); // clear input

                    e.preventDefault(); // stop 
                    return false;
                }
            });
        });
    }
    var nl2br = function(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }


    // on load
    initializeChat();
});
</script>