package api

import (
	"bytes"
	"encoding/json"
	"fmt"
	"github.com/cj123/canijailbreak.com/model"
	"net/http"
)

const CanIJailbreakURL = "https://canijailbreak.com/"

type JailbreakClient struct {
	Base string
}

func (c *JailbreakClient) GetJailbreaks() (*model.Jailbreaks, error) {
	var jbs *model.Jailbreaks

	resp, err := c.MakeRequest(CanIJailbreakURL+"jailbreaks.json", &jbs, nil)

	if err != nil {
		return nil, err
	}

	defer resp.Body.Close()

	return jbs, nil
}

func (c *JailbreakClient) MakeRequest(url string, output interface{}, headers map[string]string) (*http.Response, error) {
	request, err := http.NewRequest("GET", c.Base+url, nil)

	if err != nil {
		return nil, err
	}

	request.Header.Add("Accept", "application/json")

	for key, val := range headers {
		request.Header.Add(key, val)
	}

	res, err := http.DefaultClient.Do(request)

	if err != nil {
		return nil, err
	}

	if res.StatusCode > 400 {
		return nil, fmt.Errorf("api: invalid status code observed (%d) for URL: %s", res.StatusCode, url)
	}

	if output != nil {
		buf := new(bytes.Buffer)
		_, err = buf.ReadFrom(res.Body)

		if err != nil {
			return nil, err
		}

		err = json.Unmarshal(buf.Bytes(), &output)
	}

	return res, err
}
