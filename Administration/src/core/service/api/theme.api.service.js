import ApiService from 'src/core/service/api.service';

/**
 * Gateway for the API end point "theme"
 * @class
 * @extends ApiService
 */
class ThemeApiService extends ApiService {
    constructor(httpClient, loginService, apiEndpoint = 'theme') {
        super(httpClient, loginService, apiEndpoint);
        this.name = 'themeService';
    }

    assignTheme(themeId, salesChannelId, additionalParams = {}, additionalHeaders = {}) {
        const apiRoute = `/_action/${this.getApiBasePath()}/${themeId}/assign/${salesChannelId}`;

        return this.httpClient.post(
            apiRoute,
            {},
            {
                params: { ...additionalParams },
                headers: this.getBasicHeaders(additionalHeaders)
            }
        ).then((response) => {
            return ApiService.handleResponse(response);
        });
    }

    updateTheme(themeId, data, additionalParams = {}, additionalHeaders = {}) {
        const apiRoute = `/_action/${this.getApiBasePath()}/${themeId}`;

        return this.httpClient.patch(
            apiRoute,
            data,
            {
                params: { ...additionalParams },
                headers: this.getBasicHeaders(additionalHeaders)
            }
        ).then((response) => {
            return ApiService.handleResponse(response);
        });
    }

    getConfiguration(themeId, languageId) {
        const apiRoute = `/_action/${this.getApiBasePath()}/${themeId}/configuration`;

        const additionalHeaders = { 'sw-language-id': languageId };

        return this.httpClient.get(
            apiRoute,
            {
                headers: this.getBasicHeaders(additionalHeaders)
            }
        ).then((response) => {
            return ApiService.handleResponse(response);
        });
    }

    getFields(themeId, languageId) {
        const apiRoute = `/_action/${this.getApiBasePath()}/${themeId}/fields`;

        const additionalHeaders = { 'sw-language-id': languageId };

        return this.httpClient.get(
            apiRoute,
            {
                headers: this.getBasicHeaders(additionalHeaders)
            }
        ).then((response) => {
            return ApiService.handleResponse(response);
        });
    }
}

export default ThemeApiService;
