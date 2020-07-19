
export const marvelApiUrl = 'http://127.0.0.1:8000/marvel/'

export async function getSerie (id) {
  const res = await fetch(marvelApiUrl + 'serie/' + id)
  return res.json()
}

export async function getSeries (params = {}) {
  const url = new URL(marvelApiUrl + 'series')
  Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
  const res = await fetch(url)
  return res.json()
}

export async function getCharacter (id) {
  const res = await fetch(marvelApiUrl + 'character/' + id)
  return res.json()
}

export async function getComics (serieId, params) {
  const url = new URL(marvelApiUrl + 'serie/' + serieId + '/comics')
  Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
  const res = await fetch(url)
  return res.json()
}
