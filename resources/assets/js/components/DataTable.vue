<template>
<div class="card is-shady">
  <div class="card-header">{{response.table}}</div>

  <div class="card-content">
    <table class="table is-striped is-fullwidth">
      <thead>
        <tr>
          <th v-for="column in response.displayable">
            {{ column }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="record in response.records">
          <td v-for="columnValue, column in record">
            {{columnValue}}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['endpoint'],
  data () {
    return {
      response: {
        table: '',
        displayable: [],
        records: []
      }
    }
  },
  mounted () {
    this.getRecords()
  },
  methods: {
    getRecords () {
      return axios.get(`${this.endpoint}`).then((response) => {
        this.response = response.data.data
      })
    }
  }
}
</script>
