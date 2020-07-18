
export const marvelApiUrl = '/api/'

// let charactersCache = {}

export async function getSerie (id) {
  const res = await fetch(marvelApiUrl + 'serie.json')
  return res.json()
}

export async function getSeries (opts) {
  const res = await fetch(marvelApiUrl + 'series.json')
  return res.json()
}

export function clearCharacterCache () {
  // charactersCache = {}
}
