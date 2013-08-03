WDIM393_hw2
===========

WDIM393F Homework 2

After the smashing success of Sharknado, the filmmakers have decided to build a WordPress site to hype their next blockbuster, Sharkquake. Much of the success of Sharknado has been attributed to excellent social media marketing. The filmmakers would like to use that same strategy to hype Sharkquake. After trialing some disappointing social media plugins, they have hired you to build a WordPress plugin that integrates sharing services from AddThis. They are excited about AddThis because it integrates a number of social media services with minimal effort.

They explain that they would like to use AddThis buttons because they "look cool" by hovering to either the left or right. The client is so excited that they show you how the buttons will look on the default WordPress theme:



They also confide that they are not certain if it is better to have the buttons on the left or the right. Moreover, they want the ability to easily switch where the buttons are located and ask you to build a simple setting that allows them to change the positioning. Additionally, after reading AddThis' documentation, they learn that you can show between 1 and 6 buttons in the hover menu. Again, they find this to be "far out", but they are not certain how many buttons they want. As such, they ask you to build in an option so that they can easily change it. Finally, they want the ability to easily turn off sharing. They ask you to build in a simple option for this.

In discussing the specifications with the client, you have agreed on the following:

You will build a WordPress plugin that adds AddThis share buttons.
Buttons will only appear on single post pages and nowhere else on the site.
There will be a settings page for the plugin that gives the client the ability to change the following:
Button position (left or right)
The number of buttons shown (can be any number from 1 to 6)
Disable the buttons temporarily through an option


Things to Think About

To get the code for adding AddThis buttons to a page, you will need to visit AddThis.com and explore their Smart Layers API. You will want to get the "widget" code for the "Share" buttons.
To begin, it might be easiest to get the AddThis code working in the theme that you are using on your development site by adding the code directly to the theme templates. Then, work on figuring out how you can add this code via a plugin using WordPress hooks.
I recommend first trying to get the buttons to work. Then, try to implement the settings. These are two very different problems and are probably best addressed independently.
Be sure that the correct title is being utilized when clicking the share buttons.
For the sanitize_callback argument for the position setting, you can use sanitize_key for this assignment.
As you work on this assignment, commit your work frequently. This is helpful for three reasons:
If you are having difficulties with the assignment and need assistance, I can see where you are getting hung up if you are regularly committing your work.
In grading the homework, I need to see how you arrived at the final version of the code. I can possibly reward more points if I can see the history of your work.
I can see that the work was legitimately yours if it is documented in git.
What to turn in

By July 29, 2013 at 6 PM PST, you must send me an email (see syllabus for email address) with all of the following:

Email me a copy of your plugin as a .zip file. I should be able to easily install the plugin through the WordPress admin.
Email me a link to the plugin on your Github account. It is very important that I am able to see your work on this assignment through Github commits.

