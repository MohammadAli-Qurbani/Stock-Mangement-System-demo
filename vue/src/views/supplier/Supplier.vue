<template>
  <main id="main" class="main">
    <div class="pagetitle" style="overflow: hidden">
      <button class="float-right btn btn-outline-primary" @click="closeModal(modelType)">
        add supplier info
      </button>
    </div>
    <!-- End Page Title -->
    <div v-if="show">
      <!-- modal -->
      <Modal @closeModal="closeModal(modelType)">
        <div class="card">
          <div class="card-header">adding new supplier</div>
          <div class="card-body">
            <form @submit.prevent="addSupplier" id="supplierForm">
              <label for="">company name </label>
              <input
                type="text"
                class="form-control mb-2"
                name="company_name"
                id="company_name"
              />
              <p class="text-danger" v-if="supplierStore.errors.company_name">
                {{ supplierStore.errors.company_name[0] }}
              </p>
              <label for="">phone</label>
              <input type="tel" class="form-control mb-2" name="phone" />
              <p class="text-danger" v-if="supplierStore.errors.phone">
                {{ supplierStore.errors.phone[0] }}
              </p>

              <label for="">email</label>
              <input type="email" class="form-control mb-2" name="email" />
              <p class="text-danger" v-if="supplierStore.errors.email">
                {{ supplierStore.errors.email[0] }}
              </p>
              <label for="">city</label>
              <input type="text" class="form-control mb-2" name="city" />
              <p class="text-danger" v-if="supplierStore.errors.city">
                {{ supplierStore.errors.city[0] }}
              </p>
              <label for="">district</label>
              <input type="text" class="form-control mb-2" name="district" />
              <p class="text-danger" v-if="supplierStore.errors.district">
                {{ supplierStore.errors.district[0] }}
              </p>
              <button class="btn btn-success">submit info</button>
            </form>
          </div>
        </div>
      </Modal>
    </div>
    <div v-if="editModal">
      <!-- modal -->
      <Modal @closeModal="closeModal(modelType)">
        <div class="card">
          <div class="card-header">editing supplier info</div>
          <div class="card-body" v-if="Object.keys(supplierStore.supplier).length">
            <form
              @submit.prevent="updateSupplier(supplierStore.supplier.id)"
              id="editSupplierForm"
            >
              <label for="">company name </label>
              <input
                type="text"
                class="form-control mb-2"
                name="company_name"
                :value="supplierStore.supplier.company_name"
              />
              <p class="text-danger" v-if="supplierStore.errors.company_name">
                {{ supplierStore.errors.company_name[0] }}
              </p>
              <label for="">phone</label>
              <input
                type="tel"
                class="form-control mb-2"
                name="phone"
                :value="supplierStore.supplier.phone"
              />
              <p class="text-danger" v-if="supplierStore.errors.phone">
                {{ supplierStore.errors.phone[0] }}
              </p>
              <label for="">email</label>
              <input
                type="email"
                class="form-control mb-2"
                name="email"
                :value="supplierStore.supplier.email"
              />
              <p class="text-danger" v-if="supplierStore.errors.email">
                {{ supplierStore.errors.email[0] }}
              </p>
              <label for="">city</label>
              <input
                type="text"
                class="form-control mb-2"
                name="city"
                :value="supplierStore.supplier.city"
              />
              <p class="text-danger" v-if="supplierStore.errors.city">
                {{ supplierStore.errors.city[0] }}
              </p>
              <label for="">district</label>
              <input
                type="text"
                class="form-control mb-2"
                name="district"
                :value="supplierStore.supplier.district"
              />
              <p class="text-danger" v-if="supplierStore.errors.district">
                {{ supplierStore.errors.district[0] }}
              </p>
              <button class="btn btn-success">update info</button>
            </form>
          </div>
          <h2 v-else>loading...</h2>
        </div>
      </Modal>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="card-header d-flex justify-content-between">
                <h3>Suppliers</h3>
                <input
                  type="text"
                  class="mt-2"
                  placeholder="search"
                  v-model="searchSupplier"
                />
              </div>
              <!-- Default Table -->
              <table class="table" v-if="Object.keys(supplierStore.suppliers).length">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">phone</th>
                    <th scope="col">District</th>
                    <th scope="col">City</th>
                    <th scope="col">actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="supplier in supplierStore.suppliers" :key="supplier.id">
                    <th scope="row">{{ supplier.id }}</th>
                    <td>{{ supplier.company_name }}</td>
                    <td>{{ supplier.email }}</td>
                    <td>{{ supplier.phone }}</td>
                    <td>{{ supplier.district }}</td>
                    <td>{{ supplier.city }}</td>

                    <td>
                      <button
                        class="btn-sm btn btn-success mx-2"
                        @click="editSupplier(supplier.id)"
                      >
                        <i class="bx bx-edit"></i>
                      </button>
                      <button
                        class="btn-sm btn btn-danger"
                        @click="deleteSupplier(supplier.id)"
                      >
                        <i class="bx bx-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <NotFound v-else />
              <nav v-if="supplierStore.paginate.last_page !== 1">
                <ul class="pagination mt-2">
                  <li
                    class="page-item"
                    v-for="(link, index) in supplierStore.paginate.links"
                    :key="index"
                    :class="[!link.url ? 'disabled' : '']"
                  >
                    <a
                      class="page-link"
                      v-html="link.label"
                      href="#"
                      @click="goForPage(link)"
                      :class="[link.active ? 'active' : '']"
                    ></a>
                  </li>
                </ul>
              </nav>

              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script setup>
import { ref, watch } from "vue";
import Modal from "../../components/modal/Modal.vue";
import { useSpplierStore } from "../../stores/supplier";
import { debounce } from "lodash";
import NotFound from "../../components/pageNotFound/NotFound.vue";
import swal from "sweetalert";
const supplierStore = useSpplierStore();

supplierStore.AllSuppliers();
let show = ref(false);
let editModal = ref(false);
let deleteModal = ref(false);
let modelType = ref("add");
const searchSupplier = ref(null);
const closeModal = (type) => {
  if (type === "add") {
    show.value = !show.value;
  } else if (type === "edit") {
    editModal.value = !editModal.value;
  } else if (type === "delete") {
    deleteModal.value = true;
  }
};
const addSupplier = async () => {
  const form = document.getElementById("supplierForm");
  const formData = new FormData(form);
  await supplierStore.storeSupplier(formData);
  if (Object.keys(supplierStore.errors).length === 0) {
    show.value = false;
  }
};

const editSupplier = async (id) => {
  modelType.value = "edit";
  closeModal("edit");
  await supplierStore.edit(id);
};

const updateSupplier = async (id) => {
  let form = document.getElementById("editSupplierForm");
  const formData = new FormData(form);
  formData.append("_method", "PUT");
  await supplierStore.update(formData, id);
  if (Object.keys(supplierStore.errors).length === 0) {
    editModal.value = false;
    swal("", "update functionaly done successfuly !", "success");
  }
};

const goForPage = async (link) => {
  if (!link.url || link.active) {
    return;
  }
  // alert(link.url)
  await supplierStore.AllSuppliers(link.url, null);
};

watch(
  searchSupplier,
  debounce(() => {
    supplierStore.AllSuppliers(null, searchSupplier.value);
  }, 500)
);
</script>
