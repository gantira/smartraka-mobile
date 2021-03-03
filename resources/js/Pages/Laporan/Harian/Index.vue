<template>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Laporan Harian</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                <select
                                    @change="submit"
                                    v-model="form.company_id"
                                    class="form-control"
                                    placeholder="Pilih Cabang"
                                >
                                    <option
                                        value=""
                                        selected
                                    ></option>
                                    <option
                                        v-for="(item, key) in companies"
                                        :key="key"
                                        :value="item.id"
                                    >{{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                <select
                                    @change="submit"
                                    v-model="form.month"
                                    class="form-control"
                                >
                                    <option
                                        value=""
                                        selected
                                    ></option>
                                    <option
                                        v-for="(item, key) in selectMonth"
                                        :key="key"
                                        :value="item.id"
                                    >{{ item.name }}</option>
                                </select>

                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4 form-group">
                                <select
                                    @change="submit"
                                    v-model="form.year"
                                    class="form-control"
                                    placeholder="Pilih Cabang"
                                >
                                    <option
                                        value=""
                                        selected
                                    ></option>
                                    <option
                                        v-for="(item, key) in selectYear"
                                        :key="key"
                                        :value="item"
                                    >{{ item }}</option>
                                </select>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">Cabang </th>
                                    <th class="column-title">Tanggal </th>
                                    <th class="column-title">Kategori</th>
                                    <th class="column-title text-center">Kuantitas </th>
                                    <th class="column-title text-right">Debit </th>
                                    <th class="column-title text-right">Kredit </th>
                                    <th class="column-title text-right">Saldo </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr
                                    class="even pointer"
                                    v-for="(item, key) in harian.data"
                                    :key="key"
                                >
                                    <td class=" ">{{ item.company }}</td>
                                    <td class=" ">{{ formatDate(item.created_at) }} </td>
                                    <td class=" ">{{ item.category }}</td>
                                    <td class="text-center">{{ item.qty }}</td>
                                    <td class="text-right">{{ formatRupiah(item.debit) }}</td>
                                    <td class="text-right">{{ formatRupiah(item.credit) }}</td>
                                    <td class="text-right">{{ formatRupiah(item.saldo) }}</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <Pagination
                        :links="harian.meta.links"
                        :only="['harian']"
                    ></Pagination>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <br />

</template>

<script>
import Pagination from "@/Components/Pagination.vue";

export default {
    components: { Pagination },
    props: {
        harian: Object,
        companies: Object,
        selectMonth: Object,
        selectYear: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                company_id: null,
                month: null,
                year: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.get(route("laporan.harian.index"), {
                preserveState: true,
                preserveScroll: true,
                only: ["harian"],
            });
        },
    },
};
</script>

<style>
</style>
