# Participations


## Purpose

This widget shows the number of participants and how many of them:

- are active
- are inactive
- have graduated


## Visualisation

A ring/donut chart is visually more interesting than a stacked bar chart, and it represents percentages better than a pie chart would do.


## JSON

```
{
	TotalParticipants: <int>,

	// sorted descending by Percentage

	// Status and Percentage are connected by index.
	Statuses: [
		<string>, // Active | Inactive | Graduates
		…
	],
	Percentages: [
		<float>, // >= 0 && <= 1
		…
	],

	Count: <int> // number of entries == Statuses.length == Percentages.length
}
```

### Example

```
{
	TotalParticipants: 2350,
	Statuses: [
		'Active',
		'Inactive',
		'Graduates'
	],
	Percentages: [
		0.65, // Active
		0.35 // Inactive
		0 // Graduates
	],
	Count: 2
}
```
