<template>

	<!-- <div class="columns is-mobile is-multiline is-gapless">
		<div class="column is-12-mobile is-4-tablet is-4-desktop">
			<div class="calendar">
			    <div class="calendar-header">
			      	<span class="calendar-title" @click="moveThisMonth">
			        	{{ header.label }}
			      	</span>
			      	<span class="calendar-arrow" @click="movePreviousYear">&laquo;</span>
			      	<span class="calendar-arrow" @click="movePreviousMonth">&lsaquo;</span>
			      	<span class="calendar-arrow" @click="moveNextMonth">&rsaquo;</span>
			      	<span class="calendar-arrow" @click="moveNextYear">&raquo;</span>
			    </div>
			    <div class="calendar-weekdays">
			      	<div class="calendar-weekday" v-for="weekday in weekdays">
			        	{{ weekday.label_1 }}
			      	</div>
			    </div>
			    <div class="calendar-week" v-for="week in weeks">
				    <div class="calendar-day" :class="{ 'calendar-today': day.isToday }" v-for="day in week">
				      <span>{{ day.label }}</span>
				    </div>
				</div>
		  	</div>
		</div>
	</div> -->

	<div class="field">
        <div class="control has-icons-right">
            <input class="input datepicker-input" type="text" v-on:click="calendar = true">
            <span class="icon is-small is-right has-text-grey">
                <i class="fa fa-calendar"></i>
            </span>
            <div class="calendar datepicker" v-if="calendar">
			    <div class="calendar-header">
			    	<span class="calendar-arrow" @click="movePreviousYear">&laquo;</span>
			      	<span class="calendar-arrow" @click="movePreviousMonth">&lsaquo;</span>
			      	<span class="calendar-title" @click="moveThisMonth">
			        	{{ header.label }}
			      	</span>
			      	<span class="calendar-arrow" @click="moveNextMonth">&rsaquo;</span>
			      	<span class="calendar-arrow" @click="moveNextYear">&raquo;</span>
			    </div>
			    <div class="calendar-weekdays">
			      	<div class="calendar-weekday" v-for="weekday in weekdays">
			        	{{ weekday.label_1 }}
			      	</div>
			    </div>
			    <div class="calendar-week" v-for="week in weeks">
				    <div class="calendar-day" :class="{ 'calendar-today': day.isToday, 'not-in-month': !day.inMonth }" v-for="day in week" @click="changedate(day.year, day.month, day.day)">
				      <span>{{ day.label }}</span>
				    </div>
				</div>
		  	</div>
        </div>
    </div>

</template>

<script>
	// Calendar data
	const _daysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	const _weekdayLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
	const _weekdayLength = 1;
	const _weekdayCasing = 'title';
	const _monthLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	const _monthLength = 0;
	const _monthCasing = 'title';
	// Helper function for label transformation
	const _transformLabel = (label, length, casing) => {
	    label = length <= 0 ? label : label.substring(0, length);
	    if (casing.toLowerCase() === 'lower') return label.toLowerCase();
	    if (casing.toLowerCase() === 'upper') return label.toUpperCase();
	    return label;
	};
	// Today's data
	const _today = new Date();
	const _todayComps = {
	    year: _today.getFullYear(),
	    month: _today.getMonth() + 1,
	    day: _today.getDate()
	};
	export default {
		data(){
			return {
				calendar: false,
				real_today: _today,
				thisday: _today,
				year: _todayComps.year,
				month: _todayComps.month,
    			day: _todayComps.day,
			}
		},
		created: function () {
		},
		methods: {
			moveThisMonth() {
				this.month = _todayComps.month;
				this.year = _todayComps.year;
			},
			moveNextMonth() {
			    const { month, year } = this.nextMonthComps;
			    this.month = month;
			    this.year = year;
			},
			movePreviousMonth() {
			    const { month, year } = this.previousMonthComps;
			    this.month = month;
			    this.year = year;
			},
			moveNextYear() {
				this.year++;
			},
			movePreviousYear() {
				this.year--;
			},
		},
		mounted(){
		},
		computed: {
			changedate(y, m, d) {

		    },
			// Our component exposes month as 1-based, but sometimes we need 0-based
			monthIndex() {
				return this.month - 1;
			},
			isLeapYear() {
				return (this.year % 4 === 0 && this.year % 100 !== 0) || this.year % 400 === 0;
			},
			// Data components for previous month
			previousMonthComps() {
				if (this.month === 1) return {
				  days: _daysInMonths[11],
				  month: 12,
				  year: this.year - 1,
				}
				return {
				  days: (this.month === 3 && this.isLeapYear) ? 29 : _daysInMonths[this.monthIndex - 1],
				  month: this.month - 1,
				  year: this.year,
				};
			},
			// Data components for next month
			nextMonthComps() {
				if (this.month === 12) return {
				  days: _daysInMonths[0],
				  month: 1,
				  year: this.year + 1,
				};
				return {
				  days: (this.month === 1 && this.isLeapYear) ? 29 : _daysInMonths[this.monthIndex + 1],
				  month: this.month + 1,
				  year: this.year,
				};
			},
			// State referenced by header (no dependencies yet...)
			months() {
			    return _monthLabels.map((ml, i) => ({
			      label: ml,
			      label_1: ml.substring(0, 1),
			      label_2: ml.substring(0, 2),
			      label_3: ml.substring(0, 3),
			      number: i + 1,
			    }));
			},
			// State for weekday header (no dependencies yet...)
			weekdays() {
			    return _weekdayLabels.map((wl, i) => ({
			      label: wl,
			      label_1: wl.substring(0, 1),
			      label_2: wl.substring(0, 2),
			      label_3: wl.substring(0, 3),
			      number: i + 1,
			    }));
			},
			// State for calendar header
			header() {
				const month = this.months[this.monthIndex];
				return {
				  month,
				  year: this.year.toString(),
				  shortYear: this.year.toString().substring(2, 4),
				  label: month.label + ' ' + this.year,
				};
			},
			// Returns number for first weekday (1-7), starting from Sunday
			firstWeekdayInMonth() {
				return new Date(this.year, this.monthIndex, 1).getDay() + 1;
			},
			// Returns number of days in the current month
			daysInMonth() {
			    // Check for February in a leap year
			    if (this.month === 2 && this.isLeapYear) return 29;
			    // ...Just a normal month
			    return _daysInMonths[this.monthIndex];
			},
			weeks() {
			    const weeks = [];
			    let previousMonth = true, thisMonth = false, nextMonth = false;
			    let day = this.previousMonthComps.days - this.firstWeekdayInMonth + 2;
			    let month = this.previousMonthComps.month;
			    let year = this.previousMonthComps.year;
			    // Cycle through each week of the month, up to 6 total
			    for (let w = 1; w <= 6 && !nextMonth; w++) {
			      // Cycle through each weekday
			      const week = [];
			      for (let d = 1; d <= 7; d++) {

			        // We need to know when to start counting actual month days
			        if (previousMonth && d >= this.firstWeekdayInMonth) {
			          // Reset day/month/year counters
			          day = 1;
			          month = this.month;
			          year = this.year;
			          // ...and flag we're tracking actual month days
			          previousMonth = false;
			          thisMonth = true;
			        }

			        // Append day info for the current week
			        // Note: this might or might not be an actual month day
			        //  We don't know how the UI wants to display various days,
			        //  so we'll supply all the data we can
			        week.push ({
			          label: day.toString(),
			          day,
			          weekday: d,
			          week: w,
			          month,
			          year,
			          date: new Date(year, month - 1, day),
			          beforeMonth: previousMonth,
			          afterMonth: nextMonth,
			          inMonth: thisMonth,
			          isToday: day === _todayComps.day && month === _todayComps.month && year === _todayComps.year,
			          isFirstDay: thisMonth && day === 1,
			          isLastDay: thisMonth && day === this.daysInMonth,
			        });

			        // We've hit the last day of the month
			        if (thisMonth && day >= this.daysInMonth) {
			          thisMonth = false;
			          nextMonth = true;
			          day = 1;
			          month = this.nextMonthComps.month;
			          year = this.nextMonthComps.year;
			        // Still in the middle of the month (hasn't ended yet)
			        } else {
			          day++;
			        }
			      }
			      // Append week info for the month
			      weeks.push(week);
			    }
			    return weeks;
			},
		}
	}
</script>
