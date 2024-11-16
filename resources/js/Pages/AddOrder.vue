<script setup>
import CategoryList from "@/Pages/Components/CategoryList.vue";
import ProductList from "@/Pages/Components/ProductList.vue";
import TheBill from "@/Pages/Components/TheBill.vue";
import {computed, ref} from "vue";

let props = defineProps(["products", "categoryList", "table"]);
let emit = defineEmits(["close","saveOrder"])


//region Category-related
function changeCategory(id) {
	activeCategory.value = id
}
const activeCategory = ref(null);
//endregion
//region Products-related
const products = ref(props.products)
function productClicked(id) {
	products.value[id].selected = true;
	products.value[id].stock -= 1
}

const filteredProducts = computed(() => {
	if (activeCategory.value == null) return Object.values(products.value);
	return Object.values(products.value).filter(item => item.category_id === activeCategory.value);
})
//endregion

const bill = ref(new Map());
const billDetails = computed(()=>{
	return {
		table : props.table,
		bill
	}
})
const order = ref( (props.table.orders.length>0)?props.table.orders[0]:{} )

</script>

<template>
	<div>
		<div>
			<button @click.prevent="$emit('close')" type="button"> X close</button>
		</div>
		<div>
			<CategoryList :categoryList @categoryChanged="changeCategory"/>
			<ProductList :product-list="filteredProducts" @itemClicked="productClicked"/>
			<TheBill :billDetails/>
		</div>
		<div>
			<button @click.prevent="$emit('saveOrder')">Validate Order</button>
		</div>
	</div>
</template>

<style scoped>

</style>
