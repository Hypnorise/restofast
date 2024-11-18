<script setup>
const props = defineProps(["billDetails", "billItems"]);
const emit = defineEmits(["deleteItem", "updateQuantity"]);

function updateQuantity(id, nb) {
	let obj = {id, nb}
	emit("updateQuantity", obj)
}
</script>

<template>
	<section id="bill">
		<header>
			<h2>{{ billDetails.table.name }}</h2>
			<span>Order ref : {{ billDetails.table.orders[0]?.ref || "( New )" }}</span>
		</header>
		<section>
			<table>
				<tr>
					<th>Name</th>
					<th>Qty</th>
					<th>total</th>
				</tr>
				<tbody>
				<tr v-for="[id,product] in billItems.entries()">
					<td>{{ product.name }}</td>
					<td>
						<button :disabled="product.quantity<2"
								@click.prevent="updateQuantity(id,-1)">-
						</button>
						{{ product.quantity }}
						<button @click.prevent="updateQuantity(id,1)"
						:disabled="product.stock<1">+
						</button>
					</td>
					<td>{{ product.price * product.quantity }}</td>
					<td>
						<button v-if="!product.validated" @click.prevent="$emit('deleteItem',id)">Delete</button>
					</td>
				</tr>
				</tbody>
			</table>
		</section>
	</section>
</template>

<style scoped>
section {
	header {
		display         : flex;
		justify-content : space-between;
		align-items     : baseline;
		h2 {
			margin : 0;
		}
	}
}
</style>
