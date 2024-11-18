<script setup>
import CategoryList from "@/Pages/Components/CategoryList.vue";
import ProductList from "@/Pages/Components/ProductList.vue";
import TheBill from "@/Pages/Components/TheBill.vue";
import {computed, ref} from "vue";

let props = defineProps(["products", "categoryList", "table"]);
let emit = defineEmits(["close", "saveOrder"])

//region Category-related
function changeCategory(id) {
	activeCategory.value = id
}
const activeCategory = ref(null);
//endregion
//region Products-related
const products = ref(props.products)
const filteredProducts = computed(() => {
	if (activeCategory.value == null) return Object.values(products.value);
	return Object.values(products.value).filter(item => item.category_id === activeCategory.value);
})
//endregion
function productClicked(id) {
	let product = products.value[id];
	if (product.stock < 1) {
		console.log("no stock")
		return
	}
	if (product.selected) return
	product._stock = product.stock;
	product.selected = true;
	product.stock -= 1
	billItems.value.set({id},
		{
			quantity: 1,
			name: product.name,
			price: product.price
		})
	bill.value.set({id}, {quantity: 1});
}

function addQuantity(id, qty) {
	bill.value.set({id}, {quantity: qty})
}
const billItems = ref(new Map());
const bill = ref(new Map());
const billDetails = computed(() => {
	return {
		table: props.table,
		bill: bill.value
	}
})
// const products = ref( (props.table.orders.length>0)?props.table.orders[0]:{} )

function saveOrder() {
	emit("saveOrder", billDetails.value)
}

function deleteItem(idObj) {
	let item = billItems.value.get(idObj)
	if (!item) return
	billItems.value.delete(idObj)
	let product = products.value[idObj.id]
	product.selected = false;
	product.stock += item.quantity
}
function updateQuantity(obj) {
	let item = billItems.value.get(obj.id);
	let product = products.value[obj.id.id];
	item.quantity += obj.nb;
	if (!product._stock) product._stock = product.stock
	item.stock = product.stock;
	product.stock = product._stock - obj.nb
}

function addBillItem(id,product,validated=false) {
	billItems.value.set({id},
		{
			quantity: product.pivot.quantity,
			name: product.name,
			price: product.price,
			stock: product.stock
		})
	console.log(billItems.value.get({id:2}))
	// if (validated) billItems.value.get({id}).validated = true
}

// Init billItems with existing items in order
if (props.table.orders.length > 0) {
	for (let product of props.table.orders[0].products) {
		products.value[product.id].selected = true;
		products.value[product.id]._stock = products.value[product.id].stock;
		addBillItem(product.id,product,true)
	}
}

function test(){

}
</script>

<template>
	<div>
		<div>
			<button type="button" @click.prevent="$emit('close')"> X close</button>
		</div>
		<div>
			<CategoryList :categoryList @categoryChanged="changeCategory"/>
			<ProductList :product-list="filteredProducts" @itemClicked="productClicked"/>
			<TheBill :billDetails :billItems
					 @deleteItem="deleteItem" @updateQuantity="updateQuantity"/>
		</div>
		<div>
			<button @click.prevent="saveOrder">Validate Order</button>
		</div>
	</div>
</template>

<style scoped>

</style>
