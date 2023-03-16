		<!-- footer content -->
        <footer class="printmeBTNFunction">
          <div class="pull-right">
            Copyright © <?php date('Y'); ?>. All rights reserved.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

<script type="text/javascript">
$("form").on("submit", function(event){
	event.preventDefault();

	//debugger;

	var form = $(this)[0];
	var selectedElements = $(".validThis");
	var validation = false;
	var errorMsg = "This value is required.";
	var errorClass = ".parsley-errors-list";
	var e;

	if(selectedElements.length == 0){
		form.submit();
	}else{
		if (form.checkValidity()) {
			selectedElements.each(function(){
				e = $(this);
				if(($.trim(e.val()) == "") || (e.val() == null) || (typeof e.val() === 'undefined')){
					e.focus().parent().find(errorClass).html(errorMsg).show();
					validation = false;
					return false;
				}else{
					validation = true;
					e.parent().find(errorClass).html('').hide();
				}
			});
			if (validation == true) {
				form.submit();
			}
		}else{
			alert('All enable fields are required! Please check again all of your input.');
		}	
	}	
});
</script>