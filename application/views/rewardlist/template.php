		<div style="display: none">
			<table>
				<tbody id="template">
					<tr id="row">
						<td class="form-group">
							<textarea class="form-control" name="<?php echo $abrv;?>terms_content[]"></textarea>
						</td>
						<td>
							<input type="number" placeholder="排序號碼" class="form-control" id="<?php echo $abrv;?>terms_sort" name="<?php echo $abrv;?>terms_sort[]" aria-required="true" value="0" />
						</td>
						<td width="10%">
							<a id="delRow" class="btn red delete">
	                            <i class="fa fa-trash"></i>
	                            <span> 刪除 </span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>