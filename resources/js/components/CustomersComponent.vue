<template>

    <div>
        <div class="container">
            <form class="form-inline" action="" method="post">

                <div class="form-group">
                    <label>
                        <select v-model="selectedCountryCode" id="country" name="country"
                                class="form-control mb-2 mr-2">
                            <option value="null" selected disabled>Select Country</option>
                            <option v-for="country in countries" :value="country.code"> {{country.country}}</option>
                        </select>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <select v-model="selectedState" id="state" name="state" class="form-control mb-2 mr-2">
                            <option value="null" selected disabled>Select State</option>
                            <option value="1">Select Valid Numbers</option>
                            <option value="0">Select Not Valid Numbers</option>

                        </select>
                    </label>
                </div>
                <button type="button" class="form-control btn btn-primary mb-2" @click="filterCustomers()">Filter
                </button>
                <button type="button" class="form-control btn btn-secondary mb-2" @click="reset()">Reset
                </button>
            </form>
            <br>
        </div>
        <div class="table-responsive ">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Country</th>
                    <th>State</th>
                    <th>Country Code</th>
                    <th>Phone Number</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody class="">
                <tr v-for="customer in customers.data">
                    <td> {{customer.country}}
                    </td>
                    <td v-if="customer.is_valid === 1">
                        valid
                    </td>
                    <td v-else>
                        not valid
                    </td>

                    <td>{{customer.code}}</td>
                    <td>{{customer.phone}}</td>
                    <td>{{customer.name}}</td>

                </tr>
                </tbody>
            </table>
        </div>
        <pagination :data="customers" :limit="10" @pagination-change-page="getResults">
            <span slot="prev-nav">&lt; Previous</span>
            <span slot="next-nav">Next &gt;</span>
        </pagination>

    </div>

</template>

<script>
    export default {
        name: "customer-component",
        props: ['countries'],
        mounted() {
        },
        data() {
            return {
                customers: {},
                selectedCountryCode: null,
                selectedState: null,
                filters: null
            }
        },
        created() {
            this.getResults();
        },
        methods: {
            getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                if (this.filters) {
                    var url = '/api/customers' + this.filters + '&&page=' + page
                } else var url = '/api/customers?page=' + page;
                axios.get(url)
                    .then(response => {
                        this.customers = response.data.data;
                    });

            },
            filterCustomers() {
                this.filters = '?';
                if (this.selectedCountryCode)
                    this.filters += 'code=' + this.selectedCountryCode;
                if (this.selectedState)
                    this.filters += '&&state=' + this.selectedState;
                console.log(this.filters);
                axios.get('/api/customers' + this.filters)
                    .then(response => {
                        this.customers = response.data.data;
                    });
            },
            reset()
            {
                this.filters = null;
                this.selectedCountryCode = null;
                this.selectedState =null;
                this.getResults();
            }
        }
    }
</script>

<style scoped>

</style>
