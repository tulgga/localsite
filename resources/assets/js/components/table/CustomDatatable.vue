<template>
	<div class="data-table">
		<div class="data-table-filtering">
			<div class="columns is-mobile is-multiline">
				<div class="column is-12-mobile is-8-tablet">
					<div class="field">
					  	<div class="control">
					    	<input class="input" type="text" placeholder="Хайх утга">
					  	</div>
					</div>
				</div>
				<div class="column is-12-mobile is-4-tablet">
					<div class="field">
					  	<div class="control">
					    	<div class="select is-fullwidth">
						      	<select>
							        <option></option>
						      	</select>
						    </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table is-bordered is-striped is-hoverable is-fullwidth">
				<thead>
					<tr>
						<th v-for="item in columns">
							<span>{{ options.headings[item]?options.headings[item]:item }}</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<template v-if="data.length > 0">
						<template v-for="row in data">
							<tr>
								<template v-for="column in columns">
									<!-- <td>{{ row[column] }}</td> -->
									<!-- <td>
										<slot name="profile_pic"></slot>
									</td> -->
								</template>
							</tr>
						</template>
					</template>
					<template v-else="">
						<tr class="data-table_no-results">
							<td class="text-center" :colspan="columns.length">Таарах дата байхгүй</td>
						</tr>
					</template>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
    export default {
        props:[
            'data',
            'columns',
            'options'
        ],
        data(){
            return {
            }
        },
    }
</script>