<script>
$(function(){
    $('#schoolVoting').submit(function(){
        var radioVal = $('.voteRadio:radio:checked').val();
        
        if(radioVal){
            $.ajax({
                type: "POST",
                url: '<?= Yii::app()->request->baseUrl . '/voteAnswer/voting'; ?>',
                dataType : "json",
                data:{voteRadio: radioVal, },
                success: function(data) {
                    $(".vote-forum-left").html('<div class="col-md-12">' + data + '</div>');
                }
            });
        }
        else {
            $(".votingResult").append('<strong>Выберите ответ</strong>');
        }
        return false;
    });
    
})
</script>
<div class="row vote-forum-left">
    <div class="col-md-12">
      <!-- -->
      <p class="headline"><?= $needVote->title; ?></p>
      <form id="schoolVoting" name="schoolVoting" action="<?= Yii::app()->request->baseUrl . '/voteAnswer/voting'; ?>" type="POST">

        <?php 
            foreach($needVote->voteAnswers as $needAnswer):
        ?>
          <div class="listtxt">
              <input type="radio" id="voteRadio_<?= $needAnswer->id; ?>" class="voteRadio" name="voteRadio" value="<?= $needAnswer->id; ?>">
              <label for="voteRadio_<?= $needAnswer->id; ?>"><?= $needAnswer->description; ?></label>
          </div>
        <?php endforeach; ?>

        <input type="submit" class="btn btn-yellow" value="Голосовать" />
      </form>
      <!-- -->
      <div class="votingResult"></div>
  </div>
</div>