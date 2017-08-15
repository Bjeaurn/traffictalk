export class UrlBuilder {

  private static readonly segmentDelimiters = "/"

  constructor(
    private segments: string[],
    private parameters: { [p: string]: string }) {
  }

  static fromPattern(pattern: string): UrlBuilder {
    return new UrlBuilder(pattern.split(UrlBuilder.segmentDelimiters), {})
  }

  private asParameter(segment: string): string | null {
    const regex = new RegExp(`^:([^/]+)$`)
    const matches = regex.exec(segment)
    if (matches === null) {
      return null
    } else {
      return matches[1]
    }
  }

  add(pattern: string): UrlBuilder {
    const segments = this.segments.concat(pattern.split(UrlBuilder.segmentDelimiters))
    return new UrlBuilder(segments, this.parameters)
  }

  withParameter(key: string, value: string): UrlBuilder {
    return this.withParameters({ [key]: value })
  }

  withParameters(parameters: { [k: string]: string }): UrlBuilder {
    const updatedParameters = {}
    Object.assign(updatedParameters, this.parameters, parameters)
    return new UrlBuilder(this.segments, updatedParameters)
  }

  build(): string {
    const pathParameters: string[] = []
    const segmentsWithParameters: string[] = []
    this.segments.forEach(segment => {
      const parameter = this.asParameter(segment)
      if (parameter === null) {
        segmentsWithParameters.push(segment)
      } else {
        const parameterValue = encodeURIComponent(this.parameters[parameter])
        segmentsWithParameters.push(parameterValue)
        pathParameters.push(parameter)
      }
    })

    const queryParameters = Object.keys(this.parameters)
      .filter(parameter => {
        return pathParameters.indexOf(parameter) === -1
      })
      .map(queryParameter => {
        const parameterValue = encodeURIComponent(this.parameters[queryParameter])
        return queryParameter + "=" + parameterValue
      })

    return segmentsWithParameters.join("/") + (queryParameters.length > 0 ? "?" : "") + queryParameters.join("&")
  }

}