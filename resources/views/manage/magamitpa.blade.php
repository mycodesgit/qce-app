@php
		    $no = 1; 
		@endphp

		@foreach ($quest->groupBy('catName') as $catName => $questions)
		    <table id="table">
		        <thead>
		            <tr>
		                <th style="font-weight: bold !important; text-align: left;">{{ $catName }}</th>
		                <th style="font-weight: bold !important; text-align: center;" width="30%">Scale</th>
		            </tr>
		        </thead>
		        <tbody>
		            @foreach($questions as $dataquest)
		                <tr>
		                    <td>{{ $no++ }}. {{ $dataquest->questiontext }}</td>
		                    <td>
		                        @for ($i = 5; $i >= 1; $i--) <!-- Reverse order from 5 to 1 -->
		                        <div style="display: inline-block; margin-right: 5px; vertical-align: middle; margin-top: 20px;">
		                            <input style="display: inline-block; vertical-align: middle;" 
		                                   type="radio" 
		                                   name="rate[{{ $dataquest->question }}][]" 
		                                   value="{{ $i }}" 
		                                   id="radio{{ $dataquest->question }}_{{ $i }}">
		                            <label style="display: inline-block; margin-right: 2px; vertical-align: middle;" 
		                                   for="radio{{ $dataquest->question }}_{{ $i }}">
		                                {{ $i }}
		                            </label>
		                        </div>
		                        @endfor
		                    </td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
		@endforeach