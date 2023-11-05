<template>
    <div class="table-responsive">
        <table class="table table-hover border-primary border-2">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Holiday Name(s)</th>
                <th scope="col">Holiday Type</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(holiday, i) in data" :key="i">
                <td>
                    <p class="mb-0">{{formatDate(holiday.date.day,holiday.date.month,holiday.date.year)}}</p>
                    <p class="mb-0 fw-bold" v-if="holiday.observedOn"><i>(Observed on: {{formatDate(holiday.observedOn.day,holiday.observedOn.month,holiday.observedOn.year)}})</i></p>
                </td>
                <td>
                    <p class="mb-0" v-for="(name,x) in holiday.name" :key="x">
                       ({{x+1}}) {{name.text}} <b>({{name.lang}})</b>
                    </p>
                </td>
                <td>
                    <p class="mb-0 text-capitalize">{{formatType(holiday.holidayType)}}</p>
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
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ]
    const formattedDay = day < 10 ? `0${day}` : day
    return `${formattedDay} ${months[month - 1]} ${year}`
}

</script>

<style scoped>

</style>
