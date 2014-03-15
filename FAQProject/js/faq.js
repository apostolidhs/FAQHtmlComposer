$( document ).ready(function() {
  
	var CATEGORY = "faq-cat";
	var CATEGORY_ID_PREFIX = "cat-"
	var GROUP_ID_PREFIX = "ph-"
	var GROUP = "faq-phase";
	var ANSWERQUESTION = "faq-ansque";
	var QUESTION = "faq-que";
	var QUESTION_MSG = "faq-que-msg";
	var ANSWER = "faq-ans";


	var QUEST_ICON = "faq-expand-icon";
	var QUEST_ICON_UP = "glyphicon-chevron-up";
	var QUEST_ICON_DOWN = "glyphicon-chevron-down";

	function ActivatePhase(id){
		$( "." + ANSWER ).hide();
		$( "." + CATEGORY ).parent().removeClass( "active" );
		$( "." + GROUP ).hide();
		$( "." + GROUP ).find( "." + QUEST_ICON ).removeClass( QUEST_ICON_UP ).addClass( QUEST_ICON_DOWN );
		$( "#" + CATEGORY_ID_PREFIX + id ).parent().addClass( "active" );
		if( id==='all' )
			$( "." + GROUP ).show();
		else
			$( "#" + GROUP_ID_PREFIX + id ).show();
	}

	$( "." + CATEGORY ).on( 'click', function(){
		var prefId = $(this).attr('id');
		var prefIdIndex = CATEGORY_ID_PREFIX.length;
		var id = prefId.substring(prefIdIndex);
		ActivatePhase( id );
	});

	$( "." + QUESTION ).on( 'click', function(){
		var that = this;
		var answer = $(this).parent().find( "." + ANSWER );
		if(answer.css('display')==='none'){
			answer.slideDown( function(){
				$( that ).find( "." + QUEST_ICON ).removeClass( QUEST_ICON_DOWN ).addClass( QUEST_ICON_UP );
			});
		}else{
			answer.slideUp( function(){
				$( that ).find( "." + QUEST_ICON ).removeClass( QUEST_ICON_UP ).addClass( QUEST_ICON_DOWN );
			});
		}		
	});

	$( "." + QUESTION ).hover(
	  function() {
	    $( this ).find( "." + QUEST_ICON ).show();
	  }, function() {
	    $( this ).find( "." + QUEST_ICON ).hide();
	  }
	);

});