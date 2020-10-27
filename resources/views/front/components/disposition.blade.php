<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
	<div class='wolf-row-inner' style='padding-top:5px;'>
		<div class="wrap">
			<div class="col-6 wolf-col">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
							<table class="content-light-font aligncenter" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<tr>
									<th class="brdr" style="text-align: center;" width="160">{{ __('front.place') }}</th>
									<th class="brdr" style="text-align: center;">{{ __('front.busy_member')}}</th>
									</tr>
									@foreach ($dispositionPlaces as $item)
									<tr>
										<td>{{ $item->place }}</td>
										<td>{{ $item->member }}</td>
									</tr>										
									@endforeach
								</tbody>
							</table>
							{!! $dispositionPlaces->render() !!}
						</div> 
					</div> 
				</div> 
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    /*     $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        }); */
        window.onload = function(){
            var links = document.getElementsByTagName('A');
                for(var i = 0; i < links.length; i++){
                if(links[i].className == 'page-link'){
                    var myRe = /page=[0-9]/g;
                    var str = links[i].href;
                    var myArray;
                    while ((myArray = myRe.exec(str)) !== null) {
                    var msg = myArray[0];
                    }
    
                    var page= msg.split('page=')[1];				
                    links[i].href = 'disposition#page=' +page;
                }
			}
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                var links = document.getElementsByTagName('A');
                for(var i = 0; i < links.length; i++){
                if(links[i].className == 'page-link'){
                    var myRe = /page=[0-9]/g;
                    var str = links[i].href;
                    var myArray;
                    while ((myArray = myRe.exec(str)) !== null) {
                    var msg = myArray[0];
                    }
    
                    var page= msg.split('page=')[1];				
                    links[i].href = 'disposition#page=' +page;
                }
            }                
                var page2 = $(this).attr('href').split('page=')[1];
                getData(page2); 
                
            });			
        };	    
        /* jQuery(document).ready(function()
        {

    
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                var links = document.getElementsByTagName('A');
                for(var i = 0; i < links.length; i++){
                if(links[i].className == 'page-link'){
                    var myRe = /page=[0-9]/g;
                    var str = links[i].href;
                    var myArray;
                    while ((myArray = myRe.exec(str)) !== null) {
                    var msg = myArray[0];
                    }
    
                    var page= msg.split('page=')[1];				
                    links[i].href = 'disposition#page=' +page;
                }
            }                
                var page2 = $(this).attr('href').split('page=')[1];
                console.log(page2);
                getData(page2); 
                
            }); 
      
        });*/
      
        function getData(page){
            $.ajax(
            {
                url: 'disposition?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
                $("#disposition-places").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                  alert('No response from server');
            });
        }
    </script>