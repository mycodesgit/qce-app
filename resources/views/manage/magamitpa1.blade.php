@foreach ($quest->groupBy('catName') as $catName => $questions)
		    @php $no = 1; @endphp 

		    <table id="table" border="1" style="border-collapse: collapse; width: 100%;">
		        <thead>
		            <tr>
		                <th style="font-weight: bold !important; text-align: left;">{{ $catName }}</th>
		                <th style="font-weight: bold !important; text-align: center;" colspan="5">Scale</th>
		            </tr>
		            {{-- <tr>
		                <th style="text-align: left;"></th>
		                <th style="text-align: center;">5</th>
		                <th style="text-align: center;">4</th>
		                <th style="text-align: center;">3</th>
		                <th style="text-align: center;">2</th>
		                <th style="text-align: center;">1</th>
		            </tr> --}}
		        </thead>
		        <tbody>
		            @foreach($questions as $dataquest)
		                <tr>
		                    <td>{{ $no++ }}. {{ $dataquest->questiontext }}</td>
		                    @for ($i = 5; $i >= 1; $i--) 
		                        <td style="text-align: center;">
		                            <input type="radio" 
		                                   name="rate[{{ $dataquest->question }}][]" 
		                                   value="{{ $i }}" 
		                                   id="radio{{ $dataquest->question }}_{{ $i }}">
		                            <label style="display: inline-block; margin-right: 2px; vertical-align: middle;" 
		                                   for="radio{{ $dataquest->question }}_{{ $i }}">
		                                {{ $i }}
		                            </label>
		                        </td>
		                    @endfor
		                </tr>
		            @endforeach
		            <tr>
	                	<td style="text-align: right; font-weight: bold;">Total Score</td>
	                    @for ($i = 5; $i >= 1; $i--) 
	                        <td style="text-align: center;">
	                            
	                        </td>
	                    @endfor
	                </tr>
		        </tbody>
		    </table>
		    <br>
		@endforeach