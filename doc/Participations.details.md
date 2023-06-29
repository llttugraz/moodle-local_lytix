# Participations


## Purpose

The widget shows the change of participation numbers over time.


## Visualisation

A line chart or a fine-grained bar chart.


## JSON

**WORK IN PROGRESS**

```
{
	Keys: [ <string>, … ], // Enrolment | Start | Graduation | Login
	Values: [
		{
			Date: [ <int> ], // UNIX timestamp
			Value: [ <int> ],  // change of value
			Count: <int> // number of entries
		},
		…
	],
	Count: <int> // number of entries == EventType.length == Changes.length
}
```
