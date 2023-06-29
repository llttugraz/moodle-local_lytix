# Course Completion

## Purpose

A small glance at some numbers the creators can be proud of.


## Visualisation

Just a simple list, as the data is not directly related. The course duration is added for context.


## JSON

```
{
	StartDate: <int>, // UNIX timestamp
	EndDate: <int>, // UNIX timestamp

	Enrolments: <int>, // excluded from Keys/Values, because it has to be displayed in any case

	// Indexes have to correspond with Values.
	// Keys should appear in the following order.
	Keys: [
			'Graduates',
			'Certificates',
			'FeedbackForms',
			'Badges'
	],
	Values: [
		<int>,
		…
	]
}
```

### Example

```
{
    StartDate: 1579737600,
    EndDate: 1591228800,
    Enrolments: 2350,
    Keys: [
        'Certificates',
        'FeedbackForms',
        'Badges'
    ],
    Values: [
        385,
        408,
        0
    ]
}
```
