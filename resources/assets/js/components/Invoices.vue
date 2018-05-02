<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Category</th>
                <th scope="col">Vendor</th>
                <th scope="col">Customer</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody v-if="hasInvoices">
                <tr v-for="invoice in invoices.data">
                    <td>{{ invoice.category.name }}</td>
                    <td>{{ invoice.vendor.name }}</td>
                    <td>{{ invoice.customer.name }}</td>
                    <td>{{ invoice.status.name }}</td>
                    <td>{{ invoice.price }}</td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <select v-model="selected_category" class="form-control">
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                    </td>
                    <td>
                        <select v-model="selected_vendor" class="form-control">
                            <option v-for="vendor in vendors" :value="vendor.id">{{ vendor.name }}</option>
                        </select>
                    </td>
                    <td>
                        <select v-model="selected_customer" class="form-control">
                            <option v-for="customer in customers" :value="customer.id">{{ customer.name }}</option>
                        </select>
                    </td>
                    <td>
                        <select v-model="selected_status" class="form-control">
                            <option v-for="status in statuses" :value="status.id">{{ status.name }}</option>
                        </select>
                    </td>
                    <td>
                        <input v-model="selected_price" class="form-control" type="number">
                    </td>
                    <td>
                        <button @click="addInvoice" class="btn btn-primary mb-2">Add invoice</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="row">
            <pagination
                    :data="invoices"
                    :limit="3"
                    v-on:pagination-change-page="fetchInvoices"
                    class="col align-self-center">
            </pagination>
        </div>
    </div>
</template>

<script>

    import pagination from './Pagination.vue';

    export default {
        name: 'Invoices',

        components: {
            pagination
        },

        data() {
            return {
                invoices: {},
                current_page: 1,
                categories: null,
                vendors: null,
                customers: null,
                statuses: null,
                price: 0,
                selected_category: null,
                selected_vendor: null,
                selected_customer: null,
                selected_status: null,
                selected_price: 0
            }
        },

        created() {
            this.fetchInvoices(this.current_page);
            this.fetchCategories();
            this.fetchVendors();
            this.fetchCustomers();
            this.fetchStatuses();
        },

        computed: {
            hasInvoices: function() {
                if (typeof this.invoices.data !== 'undefined' && Array.isArray(this.invoices.data)) {
                    return this.invoices.data.length > 0;
                } else {
                    return false;
                }
            }
        },

        methods: {
            fetchInvoices(page) {
                if (typeof page === 'undefined') {
                    page = this.page;
                } else {
                    this.page = page;
                }
                axios.post('/invoices/list', {
                    page: this.page
                })
                .then(response => {
                    this.invoices = response.data.invoices;
                })
                .catch(error => {
                    console.log(error);
                });
            },

            fetchCategories() {
                axios.post('/invoices/categories/list')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                        console.log(error);
                });
            },

            fetchVendors() {
                axios.post('/vendors/list')
                .then(response => {
                    this.vendors = response.data;
                })
                .catch(error => {
                        console.log(error);
                });
            },

            fetchCustomers() {
                axios.post('/customers/list')
                .then(response => {
                    this.customers = response.data;
                })
                .catch(error => {
                        console.log(error);
                });
            },

            fetchStatuses() {
                axios.post('/invoices/statuses/list')
                .then(response => {
                    this.statuses = response.data;
                })
                .catch(error => {
                        console.log(error);
                });
            },

            addInvoice() {
                axios.post('/invoices', {
                    category_id: this.selected_category,
                    vendor_id: this.selected_vendor,
                    customer_id: this.selected_customer,
                    status_id: this.selected_status,
                    price: this.selected_price
                })
                .then(response => {
                    this.statuses = response.data;
                })
                .catch(error => {
                        console.log(error);
                });
            }
        }

    }
</script>

<style>
</style>