<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Holiday Name(s)</th>
                <th scope="col">Holiday Type</th>
                <th scope="col">Observed On</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(holiday, i) in data" :key="i">
                <td>{{formatDate(holiday.date.day,holiday.date.month,holiday.date.year)}}</td>
                <td>
                    <p class="mb-0" v-for="(name,x) in holiday.name" :key="x">
                       ({{x+1}}) {{name.text}} <b>({{name.lang}})</b>
                    </p>
                </td>
                <td><p class="mb-0 text-capitalize">{{formatType(holiday.holidayType)}}</p></td>
                <td>
                    <p class="mb-0" v-if="holiday.observedOn">{{holiday.observedOn.day}}-{{holiday.observedOn.month}}-{{holiday.observedOn.year}}</p>
                    <p class="mb-0">-</p>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>

const {data} = defineProps(['data'])

const formatType = (value) =>{
    return value.split('_').join(' ')
}

const formatDate = (day,month,year) =>{

    const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ]

    const formattedDay = day < 10 ? `0${day}` : day;

    return `${formattedDay} ${months[month - 1]} ${year}`
}

</script>

<style scoped>

</style>
