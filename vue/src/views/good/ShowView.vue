<template>
  <main id="main" class="main">
    <div class="pagetitle" style="overflow: hidden">
      <router-link :to="{ name: 'good' }" class="float-right btn btn-outline-primary"
        >go back</router-link
      >
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row" v-if="Object.keys(goodStore.good).length">
        <div class="col-lg-12">
          <div class="card bg-light shadow">
            <div class="card-header">supplier information !</div>
            <div class="card-body">
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">company name</p>
                <p class="float-right">{{ goodStore.good.supplier.company_name }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">company phone</p>
                <p class="float-right">{{ goodStore.good.supplier.phone }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">company email</p>
                <p class="float-right">{{ goodStore.good.supplier.email }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">company city</p>
                <p class="float-right">{{ goodStore.good.supplier.city }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">company district</p>
                <p class="float-right">{{ goodStore.good.supplier.district }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card bg-light shadow">
            <div class="card-header">drag information</div>
            <div class="card-body">
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">drag name</p>
                <p class="float-right">{{ goodStore.good.drag_name }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">quantity</p>
                <p class="float-right">{{ goodStore.good.quantity }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">rate</p>
                <p class="float-right">{{ goodStore.good.rate }}</p>
              </div>
              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">description</p>
                <p class="float-right">{{ goodStore.good.description }}</p>
              </div>

              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">made date</p>
                <p class="float-right" v-html="goodStore.good.dragRate.made_date"></p>
              </div>

              <div class="bg-white mt-2 p-2 rouded overflow-auto">
                <p class="float-left">expired date</p>
                <p class="float-right" v-html="goodStore.good.dragRate.expired_date"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { onMounted } from "vue";
import { useGoodStore } from "../../stores/good";
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
const goodStore = useGoodStore();
const props = defineProps({ id: { required: true } });

onMounted(() => {
  goodStore.show(props.id);
  window.scrollTo({ top: 0, behavior: "smooth" });
});
</script>
