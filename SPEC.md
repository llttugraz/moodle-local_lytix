# Widgets in LYTIX

This document defines _widgets_ in the context of LYTIX. It elaborates on their intended use and how they work.


---


## Definition

Widgets aim to visualise a certain set of data in a way that users can quickly and effortlessly gain new insights. Ideally, they should be designed to provide the necessary information to *encourage improvement*.

Widgets should assist students with reflecting on their performance and studying habits; teachers should be enabled to monitor their courses and draw conclusions on how to improve them.

Some widgets are strictly static, others allow users to change what they show, some even prompt users to enter data themselves.



## Visual Representation

### Size

Even though widgets try to be as flexible as possible in order to work in a broad variaty of environments, they often work best in certain sizes.

While all widgets have a *minimum* width, some also have a *maximum* width; when a widget is designed to show only a small portion of information it would not make sense to scale it beyond a certain width.

Widgets with small maximum width should be placed in the same row, if possible. In order to counteract visual imbalance resulting from small widgets, the remaining horizontal space should be filled with unobstrusive elements (like a light background color).

Height is less strictly restrained, as vertical scrolling is an affordable, well known user action. Especially on narrow viewports, expanding vertically is encouraged.  
Still, whenever possible, closely related data should be visible at the same time, without scrolling.

### Anatomy

Each widget should appear like an independent entity of data. Each is contained in a window-like box, that consists of a title bar and a body.

The title bar is comprised of the widget’s title and an info button; triggering that info button provides a description of the widget’s content and how to use it, contained in a pop-up similar to a tooltip.

A widget’s body shows its content or an error message (described below).



## Responsiveness

Currently, widgets are mostly designed for larger viewports. Nonetheless, scalability shoud be considered when creating a new widget, as they might ultimately be used on mobile too.

To accomplish this, either use Bootstrap (as included by Moodle) or CSS. Handling responsiveness with JavaScript should only be the last resort.

For graphical elements SVG is often the best choice — attributes like `preserveAspectRatio='none'` and `vector-effect='non-scaling-stroke'` might come in handy.

Elements that contain text are often best handled by regular HTML, as SVG text elements are not responsive by default.



## Error Handling

If there is not enough data available to create a visualisation of, this has to be communicated to the user.  

Ideally, a skeleton of the visualisation is shown, labelled with a message about not enough data being available *yet*. If a skeleton is not possible or sensible, a message should replace the content, acompanied by a recognisable icon.

In case of any other possible error a generic message should replace the widget’s body, prompting to reload the page or contact an administrator (maybe even providing an e-mail address).



## Loading

Some widgets take longer to load, especially when data has not yet been cached. To ensure users that the site is still workin we show a loading indicator. This indicator consist of an unmistakable label and a branded animation.



## Usage

Basically, only general principles of interaction design apply, some of which are:

- Don’t use custom elements when default browser elements can be used.
- Try sticking to common, well-known types of interaction.
- If custom interaction really is the best way to go, make it as effortless as possible to use, and provide a good support system.

As always, try to keep it simple.



## Markup

All widgets should follow the same structure:

```
<div class='lytix-widget'>
	<div class='title-bar'>
		<h4>Widget Title</h4>
		<span class='info'>…</span>
	</div>
	<div class='content'>
		…
	</div>
</div>
```

Maybe in the future we could use web components to provide a common `<widget>` element.



## Naming Convention (for `class` and `id`)


### `class` & `id`

According to Moodle’s Coding Style assigning ids should be avoided. If there is no other sensible way, IDs should be prefixed with *lytix*, like this `id='lytix-cursor'`.

Similarly, classes should be prefixed with a short form of the widget’s name, for a widget called *Participation* it could look like this `class='ptcp'`. The intention here is to avoid collisions with class names that might be in use elsewhere, the prefix should be chosen with this in mind.


### Backend

JSON data from webservices should use CamelCase for keys. This serves as hint to distinguish between received and manipulated/created data.



## Documentation

Each widget’s directory must contain a `README.md` explaining its purpose, markup, required data structure; please also include possible bugs, unusual design decisions and other oddities.



## Legacy


### Conformity

Many (basically all…) widgets do not fully comply with this specification, as they have been created before it. This should change at a later time.


### Naming

Many widgets have been designed to give just a glimpse of the available data. Some of them have also a counterpart, that provides much more detailed insights. One of the original ideas was to divide a dashboard in two sections labeled *Overview* and *Details*, each holding the respective type of widget.

At the moment it is uncertain if this division will be kept and how to deal with the resulting names.



## Notes


### Multiple Instances of same Widget

Widgets that need IDs to work properly cannot be instanced on the same page more than once. [Moodle’s documentation on templats](https://docs.moodle.org/dev/Templates#Coding_style) also hints on this:

> Avoid IDs for styling or javascript - IDs should never evet be used for styling as they have a high CSS specificity, and so are hard to override. In addition, IDs should be unique in the page, which implies that a template could only be used once in a page. IDs are also not ideal for javascript, for the same reason (must be unique in a page).
>
> The only acceptable case to use an ID is you need to create a one to one connection between the JS and template. In this case use the uniqid helper to generate an ID that will not conflict with any other template on the page, and use it as part of the ID.

Unfortunately, using `{{uniqid}}` only resolves to one unique string in the root template; all partials inhert this string.

A widget that is likely to be instanced multiple times should probably be designed to be able to handle this from the beginning. As soon as an approach has established itself as best practice, this section will be updated.


### Data Structure

Data is often required to be structured as follows:
```
{
	Keys: [ <string>, … ],
	Values: [ <number>, … ]
}
```

Keys and values are solely connected by index; the value for `Keys[n]` is retrieved by using the same index, `Values[n]`.

This structure has several advantages:

- iteration is easy and predictable (compared to iterating an object’s properties)
- values that are zero can just be ommitted
- structs of arrays are more compact than arrays of structs
- sometimes maybe a tiny bit more performant


### Date Values

Dates are always UNIX timestamps. JS uses milliseconds, Moodle uses seconds; when converting from the former to the latter (by dividing by 1000) make sure the result has no decimals.

> An integer value representing the number of milliseconds since January 1, 1970, 00:00:00 UTC (the ECMAScript epoch, equivalent to the UNIX epoch), with leap seconds ignored.  
<https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Date/Date#parameters>

