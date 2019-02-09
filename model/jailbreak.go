package model

type Jailbreak struct {
	Jailbroken bool   `json:"jailbroken"`
	Name       string `json:"name"`
	URL        string `json:"url"`

	Firmwares struct {
		Start string `json:"start"`
		End   string `json:"end"`
	} `json:"ios"`

	Platforms []string `json:"platforms"`
	Caveats   string   `json:"caveats"`
}

type Jailbreaks struct {
	Jailbreaks []*Jailbreak `json:"jailbreaks"`
}
