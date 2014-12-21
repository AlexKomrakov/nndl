/**
 * Created by Алексей on 11.12.2014.
 */

(function() {
    'use strict';

    angular
        .module('nndl')
        .controller('Tournaments', Tournaments)
        .controller('CreateTeam', CreateTeam);

    function Tournaments($resource) {
        //TODO Delete resource from controller
        var TournamentsResource = $resource("/api/tournaments", {}, {
            get: { method: 'GET', isArray: true }
        });

        TournamentsResource.get(function(data){
            console.log(data);
        });
        console.log("Hello world");
    }

    function CreateTeam($resource) {
        console.log("Hello");
        ////TODO Delete resource from controller
        //var TournamentsResource = $resource("/api/tournaments", {}, {
        //    get: { method: 'GET', isArray: true }
        //});
        //
        //TournamentsResource.get(function(data){
        //    console.log(data);
        //});
        //console.log("Hello world");
    }
})();