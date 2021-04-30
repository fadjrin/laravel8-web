<div
      class="mx-auto bg-gray-200"
      x-data="{ 'isDialogOpen': false }"
      @keydown.escape="isDialogOpen = false"
>

  <section class="flex">


	<!-- <button type="button" class="border p-2 bg-white hover:border-gray-500" @click="isDialogOpen = true">Add Card</button> -->
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="isDialogOpen = true">
  Add Card
</button>	
<button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded cls-save">
  Save Card Layout
</button>

    <!-- overlay -->
    <div
        class="overflow-auto"
        style="background-color: rgba(0,0,0,0.5)"
        x-show="isDialogOpen"
        :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }"
    >
      <!-- dialog -->
      <div
           class="bg-white shadow-2xl m-4 sm:m-8"
           x-show="isDialogOpen"
           @click.away="isDialogOpen = false"
      >
          <div class="flex justify-between items-center border-b p-2 text-xl">
              <h6 class="text-xl font-bold">Add Card</h6>
              <button type="button" @click="isDialogOpen = false">✖</button>
          </div>
          <div class="p-2">

		    <div class="bg-red-50 p-4 rounded flex items-start text-red-600 my-4 shadow-lg max-w-xl mx-auto error-msg">
		        <div class="text-lg">
		            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/></svg>
		        </div>
		        <div class=" px-3">
		            <h3 class="text-red-800 font-semibold tracking-wider">
		                Error 
		            </h3>
		            <ul class="list-disc list-inside">

		            </ul>
		        </div>
		    </div>

			    <div class="mt-5 md:mt-0 md:col-span-2">
			      <form>
			        <div class="shadow overflow-hidden sm:rounded-md">
			          <div class="px-4 py-12 bg-white sm:p-6">
			            <div class="grid grid-cols-6 gap-6">
			              <div class="col-span-12">
			                <label for="templateData" class="block text-sm font-medium text-gray-700">Template</label>
			                <select id="templateData" name="templateData" autocomplete="templateData" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
			                	<option value="">[ - Please select a template - ]</option>
			                	@foreach($template as $row)
			                	     <option value="{{$row['id']}}" data-path="{{$row['path']}}">{{$row['text']}}</option>
			                	@endforeach
			                </select>
			              </div>
			            </div>
			          </div>     


					<div class="p-12 flex loading-progress">
					  <div class="relative w-full bg-gray-200 rounded">
					    <div style="width: 100%" class="absolute top-0 h-4 rounded shim-blue"></div>
					  </div>
					</div>


			          <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
			            <button type="button" id="btnAddTemplate" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
			              Save
			            </button>
			          </div>
			        </div>
			      </form>
			    </div>

          </div>
      </div><!-- /dialog -->
    </div><!-- /overlay -->

  </section>
</div>


	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
	    <div class="p-12 bg-white border-b border-gray-200">
			<div class="p-12 flex loading-save">
			  <div class="relative w-full bg-gray-200 rounded">
			    <div style="width: 100%" class="absolute top-0 h-4 rounded shim-blue"></div>
			  </div>
			</div>	 
			
		    <div class="bg-red-50 p-4 rounded flex items-start text-red-600 my-4 shadow-lg max-w-xl mx-auto error-save">
		        <div class="text-lg">
		            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z"/></svg>
		        </div>
		        <div class=" px-3">
		            <h3 class="text-red-800 font-semibold tracking-wider">
		                Error 
		            </h3>
		            <ul class="list-disc list-inside0-save">

		            </ul>
		        </div>
		    </div>			   	
	        <div class="grid-stack overflow-auto"></div>
	    </div>
	</div>

	<input type="hidden" id="contentData" readonly="readonly" value="{{$content}}" />

<script type="text/javascript">
	var getTemplate = "{{ route('page.template') }}";
	var updateTemplate = "{{ route('page.updatetemplate') }}";
</script>

<script src="{{ asset('js/dashboard.js')}}?rand={{rand()}}" type="text/javascript"></script>