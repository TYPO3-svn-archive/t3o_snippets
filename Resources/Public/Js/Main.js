$(document).ready(function(){
	$(".tx-t3o-snippets .tags a").on("click", function(){
		oldVal = $("textarea[name|='tx_t3osnippets_list[newSnippet][tags]']").val();
		if(!oldVal) {
			$("textarea[name|='tx_t3osnippets_list[newSnippet][tags]']").val($(this).text());
		} else {
			$("textarea[name|='tx_t3osnippets_list[newSnippet][tags]']").val(oldVal + "," + $(this).text());
		}
	});
});