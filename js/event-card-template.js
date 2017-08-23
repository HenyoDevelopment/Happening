function template() {
    var template = [
        '<div id="template" class="card event-card">',
                    '<div class="card-header">',
                        '<div class="header-user">',
                            '<img id="user-image" class="header-user-img" src="img/profile-photos/moonrise-user.jpg" alt="">',
                        '</div>',
                        '<div class="header-text"><a id="event-host" class="user"></a></div>',
                    '</div>',
                    '<div class="img-container vertical-align">',
                        '<img id="event-image" class="card-event-img" src="" alt="event-image">',
                    '</div>',
                    '<div class="event-size-indicator-huge"></div>',
                    '<div class="card-block">',
                        '<div class="card-text-container">',
                            '<h4 id="event-name" class="card-title"><a class="event-link">Moonrise Festival 2017</a></h4>',
                            '<p id="event-date-time" class="card-event-info">Sat Aug 12 @ 10:00 am</p>',
                            '<p id="event-capacity" class="card-event-info"></p>',
                            '<p id="event-people" class="card-text"><!-- anhnestle, beefsta, and 48 others --></p>',
                            '<p id="event-tags" class="card-tags">',
                                '<!-- Find me at profile-data.js.php <a class="tags">#musicfestival</a> -->',
                            '</p>',
                        '</div>',
                        '<div class="card-btn-container">',
                            '<div class="card-btn">',
                                '<img id="event-rating" class="lit-rating" src="" alt="It is lit">',
                            '</div>',
                            '<div class="dropup-container">',
                                '<div class="dropup div-inline">',
                                   '<button class="btn card-btn interest-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">',
                                        '<i id="event-interest" class="card-icon icon-checkmark"></i>',
                                   '</button>',
                                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">',
                                        '<a class="interest-item not-interested">Not Interested</a>',
                                        '<a class="interest-item interested">Interested</a>',
                                        '<a class="interest-item going">Going</a>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',
                '</div>'
    ].join("\n");

    return template;
}