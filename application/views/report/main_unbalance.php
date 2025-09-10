

	<div class="box box-warning">
		<div class="box-header">
			<h3 class="box-title">
				<i class="fa fa-money"></i> <?php echo('<span class="important">'.$title.' - '.$cab_pilih.' '.$periode_pilih.'</span>'); ?>
			</h3>
			
		</div>
		<div class="box-body">
			
			<table id="my-grid" class="table table-bordered table-striped" style="overflow-x:scroll !important;">
				<thead>
					<tr class="bg-blue">
						<th class="text-center" rowspan="2">Journal</th>
						<th class="text-center" rowspan="2">Type</th>
						<th class="text-center" rowspan="2">Debet</th>
						<th class="text-center" rowspan="2">Credit</th>
						
					</tr>
					
				</thead>

				<tbody id="list_detail">
				<?php
					$intB	= 0;
					if($rows_header){
						foreach($rows_header as $key=>$vals){
							if($vals->total_debet !== $vals->total_kredit){
								$intB++;
								echo"<tr>";
									echo"<td class='text-center'>".$vals->nomor."</td>";
									echo"<td class='text-center'>".$vals->tipe."</td>";
									echo"<td class='text-right'>".number_format($vals->total_debet)."</td>";
									echo"<td class='text-right'>".number_format($vals->total_kredit)."</td>";									
								echo"</tr>";
							}
						}
					}
					if($intB === 0){
						echo"<tr>";
							echo"<th class='text-left text-red' colspan='4'>No Records Was Found......</th>";															
						echo"</tr>";
					}
				?>
				</tbody>
				
			</table>
					
		</div>		
	</div>

