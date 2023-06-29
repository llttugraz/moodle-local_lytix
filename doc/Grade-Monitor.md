# Grade Monitor


## JSON

We need different data, depending on if the user is a teacher or a student.

### Teacher

The data only consists of three arrays, with five entries each. Each entry represents one grade, starting with 1.
For example: `Goals[0]` is the count of students who have set grade 1 as their goal, `Goals[2]` is how many have grade 3 as their goal.

```js
{
	Goals: [ <int>, <int>, <int>, <int>, <int> ],
	Grades: [ <int>, <int>, <int>, <int>, <int> ],
	Estimations: [ <int>, <int>, <int>, <int>, <int> ]
}
```

### Student

`Items` is a struct of arrays: All arrays are connected by index, except for `OptionalIndexes` and `CheckedIndexes`, which contain the actual indexes instead.  
If `OptionalIndexes` looked like this `[ 3, 5 ]` it would mark the fourth and sixth task in `IDs`/`Names` as optional.

`Scores`, `ClassAvgs` or `Estimations` do not need to include all entries; for example, if only the first three items have been graded `Scores` only needs to contain the scores of these three entries.  
If instead only the second item has been graded `Scores` would have two entries: a negative number for the first item, and the score of the second item, for example: `[ -1, 42 ].

```js
{
	Items: {
		// ascending by date (earliest first)
		IDs: [ <int>, … ],
		Names: [ <string>, … ]
		MaxScores: [ <int>, … ], // in points

		Scores: [ <int>, … ], // in points, negative number if not yet graded
		ClassAvgs: [ <int>, … ], // in points, negative number if not yet graded

		// this number represents a percentage of points
		Estimations: [ <int>, … ], // 0–100, negative number if not yet set

		// if an item is checked and not yet graded add its index from Items to this array
		CheckedIndexes: [ <int>, … ], // ascending
		// if an item is optional (not mandatory) add its index to this array
		OptionalIndexes: [ <int>, … ], // ascending
	},

	Goal: <0–5>, // zero if not yet set

	// the first value describes how many percent are needed for a 4, the second for a 3, …
	Scheme: [ <float>, <float>, <float>, <float> ], // in percent

	// When was the last time the grading scheme has been updateted?
	// Do not include this property if the studen has already acknowledged the update. (== has actively closed the notification)
	LastSchemeUpdate: <timestamp>, // UNIX timestamp

	ShowAverage: <bool> // either: 0, 1, true, false
}
```


## Examples

### Student

```js
{
	Items: {
		IDs: [ 1, 2, 3, 4, 5, 6, 7 ],
		Names: [
			'Assignment 1', 'Quiz 1', 'Assignment 2', 'Bonus Quiz 1', 'Assignment 3', 'Bonus Quiz 2', 'Final Exam'
		],
		MaxScores: [ 15, 5, 20, 5, 20, 5, 30 ],

		Scores: [ 14, 3, 11, 4 ],
		ClassAvgs: [ 1, 3, 3 ],

		Estimations: [ 2, 3, 4, 0, 2, 90, 1 ],

		OptionalIndexes: [ 3, 5 ],
		CheckedIndexes: [ 5 ],
	},

	Goal: 2,

	Scheme: [ 50, 70, 80, 90 ],

	LastSchemeUpdate: 1641204725,
	ShowAverage: 1
}
```


## Notes

Optional items can only increase the total score: they never worsen the final grade.  
Optional items only contribute to the final grade if the total score of mandatory items is high enough to pass the course without optional items.

If optional items have already been graded they are always included in the calculation of the final grade.


## Updating Database

Each time students are about to leave the page we check if anything has to be updated. The sent JSON’s structure is similar to the received one’s:

```js
{
	// ‘estimations’ and ‘checked’ only contain items whose state has been changed
	estimations: {
		<item-id>: <0–100>,
		…
    },
	checked: {
		<item-id>: <bool>,
		…
	},

	goal: <1–5>,

	schemeUpdateSeen: <bool>,
	showAverage: <bool>
}
```

Each key is optional: If a key is not present nothing has been changed.
