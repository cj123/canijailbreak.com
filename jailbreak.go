package main

import (
	"encoding/json"
	"io/ioutil"
	"os"
)

type Jailbreak struct {
	Jailbroken bool   `json:"jailbroken"`
	Name       string `json:"name"`
	Version    string `json:"version"`
	URL        string `json:"url"`

	Firmwares struct {
		Start string `json:"start"`
		End   string `json:"end"`
	} `json:"ios"`

	Platforms []string `json:"platforms"`
	Caveats   string   `json:"caveats"`
}

type JailbreakJSON struct {
	Jailbreaks []*Jailbreak `json:"jailbreaks"`
}

func (j JailbreakJSON) marshalToFile(filename string) error {
	out, err := json.Marshal(j)

	if err != nil {
		return err
	}

	return ioutil.WriteFile(filename, out, 0644)
}

func getJailbreaks(filename string) (jb *JailbreakJSON, err error) {
	jailbreakFile, err := os.Open(filename)

	d := json.NewDecoder(jailbreakFile)

	jb = &JailbreakJSON{}
	err = d.Decode(&jb)

	if err != nil {
		return nil, err
	}

	return jb, err
}
