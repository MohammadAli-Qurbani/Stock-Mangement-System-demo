<template>
  <main class="main" id="main">
    <section class="section">
      <div class="card" v-if="Object.keys(returnedStore.returneds).length">
        <div class="card-body">
          <div class="d-flex justify-content-between p-2">
            <h3 class="float-left">Goods</h3>
            <input
              type="text"
              class="rounded"
              placeholder="search"
              v-model="searchParm"
            />
          </div>
          <!-- Default Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">qty</th>
                <th scope="col">date</th>
                <th scope="col">category</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="returned in returnedStore.returneds" :key="returned.id">
                <td>
                  {{ returned.id }}
                </td>
                <td>
                  {{ returned.stock.drag_name }}
                </td>
                <td>
                  {{ returned.returned_quantity }}
                </td>
                <td>
                  {{ returned.date }}
                </td>
                <td>
                  {{ returned.stock.category.category_name }}
                </td>
              </tr>
            </tbody>
          </table>

          <nav>
            <ul class="pagination">
              <li
                class="page-item"
                v-for="(link, index) in returnedStore.paginate.links"
                :key="index"
                :class="[!link.url ? 'disabled' : '']"
              >
                <a
                  href=""
                  class="page-link"
                  v-html="link.label"
                  :class="[link.active ? 'active' : '']"
                  @click.prevent="nextPage(link)"
                ></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <h1 v-else>
        <NotFound />
      </h1>
    </section>
  </main>
</template>
<script setup>
import { ref, watch } from "vue";
import NotFound from "../../components/pageNotFound/NotFound.vue";
import { useReturned } from "../../stores/returnBack";

const returnedStore = useReturned();
returnedStore.getReturnedGoods();

const nextPage = async (link) => {
  if (!link.url || link.active) {
    return;
  }
  window.scrollTo({ top: 0, behavior: "smooth" });
  await returnedStore.getReturnedGoods(link.url);
};

const searchParm = ref(null);
watch(searchParm, async () => {
  await returnedStore.getReturnedGoods(null, searchParm.value);
});
</script>
