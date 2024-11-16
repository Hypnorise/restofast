<script setup>
import {ref} from "vue";
import {products} from "../../../public/js/modules/models/Products.js";
import {categories} from "../../../public/js/modules/models/Categories.js";
import {tables} from "../../../public/js/modules/models/Tables.js"
import {Model} from "../../../public/js/modules/Model.js";
import Menu from "@/Pages/Components/MainMenu.vue";
import TableList from "@/Pages/Components/TableList.vue";
import AddOrder from "@/Pages/AddOrder.vue";

//region Default Requests
const productObj = ref(null);
products.get().then((products) => productObj.value = products.source)
const categoryList = ref([]);
categories.get().then((categories) => categoryList.value = categories.values())
const tableList = ref([]);
tables.get().then((tables) => tableList.value = tables.values());
//endregion

let MainMenu = {
	items: ref([
		{
			id: 0,
			slug: "counter",
			active: true,
			text: "Counter",
			iconClass: ''
		},
		'separator',
		{
			id: 1,
			slug: "settings",
			active: false,
			text: "Settings",
			iconClass: ''
		}
	]),
	setActive: function (id) {
		for (let item of this.items.value) {
			if (item == "separator") continue;
			item.active = item.id === id;
		}
	},
	getActiveMenu: function () {
		for (let item of this.items.value) {
			if (item == "separator") continue;
			if (item.active) return item
		}
	}
}
function setActiveMenu(id) {
	MainMenu.setActive(id)
}

class Tables_withOrders extends Model {
}

let tables_withOrders = new Tables_withOrders;
const tablesWithOrders = ref([]);
tables_withOrders.get(null).then((tables) => tablesWithOrders.value = tables.source)

const activeTable = ref(null);
function addOrder(tableId) {
	activeTable.value = tablesWithOrders.value[tableId]
}
function saveOrder() {

}
</script>

<template>
	<main>
		<Menu :menuItems="MainMenu.items.value" @menuClick="setActiveMenu"/>
		<section v-if="MainMenu.getActiveMenu().slug==='counter'"
				 class="counter">
			<CategoryList :categoryList/>
			<TableList :table-list="tablesWithOrders" @addOrder="addOrder"/>
		</section>
	</main>
	<section>
		<AddOrder v-if="activeTable!==null" :categoryList :products="productObj" :table="activeTable"
				  @categoryChanged="changeCategory" @close="activeTable=null"
				  @saveOrder="saveOrder"/>
	</section>
</template>

<style>
nav, section {
	border : 1px solid #000;
	margin : 0.5rem;
}
article {
	border : 1px solid #777;
	margin : 0.5rem;
}
main {
	display : flex;
}
.counter {
	flex-grow : 1;
}

#mainMenu {
	width     : 20%;
	min-width : 5rem;
	max-width : 10rem;
}
</style>
