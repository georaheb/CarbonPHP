import React from "react";
// @material-ui/core components
import withStyles from "@material-ui/core/styles/withStyles";
// @material-ui/icons

// core components
import GridContainer from "components/Grid/GridContainer.jsx";
import GridItem from "components/Grid/GridItem.jsx";
import completedStyle from "assets/jss/material-kit-react/views/componentsSections/completedStyle.jsx";

class Dependencies extends React.Component {
    render() {
        const {classes} = this.props;
        return (
            <div className={classes.section}>
                <div className={classes.container}>
                    <GridContainer justify="center">
                        <GridItem xs={12} sm={12} md={8}>
                            <h2>Dependencies & Plugins</h2>
                            <h3>
                                Composer (PHP) Dependencies
                            </h3>
                            <p>
                                php: ^7.1,<br/>
                                mustache/mustache: v2.12.0,<br/>
                                psr/log: ^1.0,<br/>
                                phpunit/phpunit-selenium: ^4.1,<br/>
                                matthiasmullie/minify: "dev-master,<br/>
                                patchwork/jsqueeze: ^2.0<br/>
                            </p>
                            <p>The above are required to get the full CarbonPHP backend functionality.</p>
                            <br/><br/>
                            <h3>NPM (JS) Dependencies</h3>
                            <p>
                                C6 can be used strictly as a php library with your custom frontend solution(s).
                                C6 Minifies and packages many of the AdminLTE plugin's JS and CSS files,
                                as well as the production build of this react application / documentation. Besides
                                the compiled resources dependacies are not shipped.
                                NPM install will not be necessary to browse the application using the built-in php
                                web server. To edit the application and run the node development sever, you will need
                                to npm install from two different directories.
                            </p>
                            <br/><br/>
                            <h3>
                                <b>AdminLTE's Dependencies</b><br/><br/>
                            </h3>
                            <p>
                                AdminLTE can be fetched from the node package.json located at the root of C6.<br/>
                                Run <b>>> npm install</b> from the root directory to use and edit AdminLTE's
                                features.<br/>
                            </p>
                            <p>
                                The following will be installed.
                                <br/> <br/>
                                admin-lte: 2.4,<br/>
                                jquery-backstretch: 2.1.16,<br/>
                                jquery-form: ^4.2.2,<br/>
                                jquery-pjax: ^2.0.1,<br/>
                                mustache: ^2.3.0"<br/>
                                <br/>
                            </p>

                            <h3><b>Material React Open Source Series</b></h3>
                            <p>
                                Material React can be fetched from the node package.json located at of
                                <b><br/><br/>[C6]/view/react/material-dashboard-react-c6/</b><br/><br/>
                                Run <b>>> npm install</b> from this directory to use and edit the React library.
                                <br/>
                                <p>
                                    @material-ui/core: 3.9.2,<br/>
                                    @material-ui/icons: 3.0.2,<br/>
                                    @types/googlemaps: 3.30.13,<br/>
                                    @types/markerclustererplus: 2.1.33,<br/>
                                    @types/react-dom: ^16.8.2,<br/>
                                    ajv: ^5.0.0,<br/>
                                    axios: ^0.18.0,<br/>
                                    chartist: 0.10.1,<br/>
                                    classnames: 2.2.6,<br/>
                                    history: 4.7.2,<br/>
                                    moment: 2.22.2,<br/>
                                    node-sass: 4.11.0,<br/>
                                    node-sass-chokidar: 1.3.3,<br/>
                                    nouislider: 12.0.0,<br/>
                                    npm-run-all: 4.1.3,<br/>
                                    perfect-scrollbar: 1.4.0,<br/>
                                    prop-types: 15.6.2,<br/>
                                    react: ^16.5.2,<br/>
                                    react-chartist: 0.13.1,<br/>
                                    react-datetime: 2.15.0,<br/>
                                    react-dom: ^16.5.2,<br/>
                                    react-google-maps: 9.4.5,<br/>
                                    react-router-dom: 4.3.1,<br/>
                                    react-scripts: 1.1.5,<br/>
                                    react-slick: 0.23.1,v
                                    react-bootstrap-sweetalert: 4.4.1,<br/>
                                    react-swipeable-views: 0.12.17,<br/>
                                    sweetalert: ^2.1.0
                                </p>
                            </p>
                        </GridItem>
                    </GridContainer>
                </div>
            </div>
        );
    }
}

export default withStyles(completedStyle)(Dependencies);