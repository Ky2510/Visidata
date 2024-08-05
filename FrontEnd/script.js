$(document).ready(function() {
    const apiURL = "https://pokeapi.co/api/v2/pokemon?limit=1000";

    $.get(apiURL, function(data) {
        let pokemonList = data.results;
        pokemonList.sort((a, b) => a.name.localeCompare(b.name));
        
        let dropdown = $('#pokemonDropdown');
        pokemonList.forEach(pokemon => {
            dropdown.append(`<option value="${pokemon.url}">${pokemon.name}</option>`);
        });

        $('#searchInput').on('input', function() {
            let searchValue = $(this).val().toLowerCase();
            $('#pokemonDropdown option').each(function() {
                let pokemonName = $(this).text().toLowerCase();
                $(this).toggle(pokemonName.indexOf(searchValue) > -1);
            });
        });

        $('#pokemonDropdown').change(function() {
            let pokemonURL = $(this).val();
            if (pokemonURL) {
                $.get(pokemonURL, function(pokemonData) {
                    let details = `<h2>${pokemonData.name}</h2>`;
                    details += `<p>Height: ${pokemonData.height}</p>`;
                    details += `<p>Weight: ${pokemonData.weight}</p>`;
                    $('#pokemonDetails').html(details);
                });
            } else {
                $('#pokemonDetails').empty();
            }
        });
    });
});
