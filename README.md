Usage is simple: use the `[logged_in][/logged_in]` and `[logged_out][/logged_out]` shortcodes to
mark text as only for logged out/in users. You can also specify roles for the logged in users
(e.g. only editor's can see this) by setting the `roles` option to a comma seperated list of the
roles that can see this (white space and case is not significant). By default admin users can see
everything, but this can be disabled on individual blocks with the `hide_for_admin` option, just
set it to any true value (true, on, yes, or 1)
